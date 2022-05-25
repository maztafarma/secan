const app = new Vue({

    el: '#bannerManager',
    data: {

        models: {

            id: '',
            image: '',
            image_url: '',
            translations: {
                title: { "en": "", "id": "" }
            }
        },

        isEdit: false,
        listData: [],
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

            var vm = this;

            var domain = laroute.route('dataBanner', []);

            axios.get(domain).then(function (response) {

                if (response.data.status == true) {
                    vm.listData = response.data.data.banner
                } else {
                    vm.listData = []
                    console.log(response.data.message)

                }
            })
        },

        editData: function (id) {


            try {

                let vm = this;

                (async () => {

                    let domain = laroute.route('editBanner', []);
                    const { status, message, data } = await axios.get('banner/edit/' + id).then(function (response) {

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

                var optForm = {
                    dataType: "json",
                    beforeSerialize: function (form, options) {
                        showLoading()
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
                $("#form_banner").ajaxForm(optForm);
                $("#form_banner").submit();

            } catch (error) {
                console.log(error)
                hideLoading()
            }


        },

        clearErrorMessage: function () {
            $('.text-error').text('')
        },

        showConfirmDelete: function (id) {
            this.models.id = id
        },

        deleteData: function () {

            try {

                let vm = this;

                const bodyFormData = new FormData();
                bodyFormData.append('_token', token);
                bodyFormData.append('id', vm.models.id);

                (async () => {

                    const { status, message, data } = await axios.post('banner/delete/', bodyFormData).then(function (response) {

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
                        vm.fetchData()
                        vm.resetFormData()
                        $('#close_confirm_modal').trigger('click');
                        notify('Success', message, 'success');
                    } else
                        notify('Error!', message, 'error');

                })()

            } catch (error) {
                console.log(error)
            }
        },

        closeForm: function () {
            this.resetFormData()
            this.clearErrorMessage()
            $('#form-open-content').slideUp('swing');
            $('.list_table').show();
        },

        clearImage: function () {
            this.models.image = ''
            this.models.image_url = ''
        },

        resetFormData: function () {

            this.models = {
                id: '',
                image: '',
                image_url: '',
                translations: {
                    title: { "en": "", "id": "" }
                }
            }

            this.isEdit = false
            $('input[type=file]').val(null)
        }
    }

});