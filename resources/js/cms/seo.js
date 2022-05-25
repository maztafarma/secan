const app = new Vue({

    el: '#seoManager',
    data: {

        models: {
            id: '',
            key_id: '',
            translations: {

                meta_title: { "en": "", "id": "" },
                meta_keyword: { "en": "", "id": "" },
                meta_description: { "en": "", "id": "" },
            }
        },
        listData: [],
        isEdit: false,
        supported_language: supported_language
    },

    mounted() {
        this.fetchData()
    },

    methods: {

        showForm: function () {

            $('#form-open-content').slideDown('swing');
            $('.list_table').hide();
        },

        fetchData: function (page) {

            try {
                console.log("RUNNN")
                var vm = this;

                (async () => {
                    const { status, message, data } = await axios.get(appDomain + '/cms/seo/data').then(function (response) {

                        return response.data

                    }).catch(function (error) {
                        if (err.response) {
                            return err.response.data;
                        }
                        else if (err.request) {
                            return err.request.data;
                        }
                        else {
                            console.log('error', err.message);
                        }
                    });

                    if (status == true) {
                        vm.listData = data
                    }
                    else {
                        vm.listData = []
                        notify('Error!', message, 'error');
                        console.log(message)
                    }
                })()

            } catch (error) {
                console.log(error)
            }
        },

        editData: function (id) {


            try {

                let vm = this;
                let params = '?type=Pages';

                (async () => {

                    const { status, message, data } = await axios.get(appDomain + '/cms/seo/edit/' + id + params).then(function (response) {

                        return response.data

                    }).catch(function (err) {

                        if (err.response) {
                            return err.response.data;
                        }
                        else if (err.request) {
                            return err.request.data;
                        }
                        else {
                            console.log('error', err.message);
                        }
                    });

                    if (status == true) {
                        vm.isEdit = true
                        vm.models = data

                        $('.list_table').hide();
                        $('#form-open-content').slideDown('swing');
                    }

                })()

            } catch (error) {
                console.log(error)
            }
        },

        saveData: function () {

            try {

                var vm = this;
                var editorObj = []

                var optForm = {
                    dataType: "json",
                    beforeSerialize: function (form, options) {
                        showLoading();
                    },
                    beforeSend: function () {
                        vm.clearErrorMessage();

                    },
                    success: function (response) {
                        if (response.status == false) {
                            if (response.is_error_form_validation) {

                                var message_validation = []
                                $.each(response.message, function (key, value) {

                                    // $('input[name="' + key.replace('.', '_') + '"]').focus();
                                    $('#field_' + key.replace('.', '_')).text(value)
                                });


                            } else {
                                notify('Error!', response.message, 'error');

                            }
                        } else {

                            vm.clearErrorMessage();
                            vm.closeForm()
                            vm.fetchData()
                            notify('Success', '', 'success');
                        }
                    },
                    complete: function (response) {
                        hideLoading()
                    }

                };
                $("#form_seo").ajaxForm(optForm);
                $("#form_seo").submit();

            } catch (error) {
                console.log(error)
                hideLoading()
            }


        },

        clearErrorMessage: function () {
            $('.text-error').text('')
        },

        closeForm: function () {
            this.resetFormData()
            this.clearErrorMessage()
            $('#form-open-content').slideUp('swing');
            $('.list_table').show();
        },

        resetFormData: function () {

            this.models = {

                id: '',
                key_id: '',
                translations: {

                    meta_title: { "en": "", "id": "" },
                    meta_keyword: { "en": "", "id": "" },
                    meta_description: { "en": "", "id": "" },
                }
            }

            this.isEdit = false
        }

    }
});