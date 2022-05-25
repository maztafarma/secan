const app = new Vue({

    el: '#doctorManager',
    data: {

        models: {

            id: '',
            foto: '',
            fullname: '',
            location: '',
            longitude: '',
            latitude: '',
            category_id: '',
            address: '',
            foto_url: '',
            phone_number: '',
            information: {
                description: { "en": "", "id": "" }
            }
        },
        isEdit: false,
        listData: [],
        listCategory: [],
        supported_language: supported_language

    },

    mounted() {
        this.fetchData()
    },

    methods: {

        showForm: function () {

            $('#form-open-content').slideDown('swing');
            $('.list_table').hide();
            this.resetFormData()
        },

        fetchData: function (page) {

            var vm = this;

            (async () => {
                const { status, message, data } = await axios.get(appDomain + '/cms/doctor/data').then(function (response) {

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
                    vm.listData = data.doctor
                    vm.listCategory = data.category
                }
                else {
                    vm.listData = []
                    notify('Error!', message, 'error');
                    console.log(message)
                }
            })()
        },

        editData: function (id) {


            try {

                let vm = this;

                (async () => {

                    const { status, message, data } = await axios.get(appDomain + '/cms/doctor/edit/' + id).then(function (response) {

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
                        $('#category_id').val(vm.models.category_id)

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
                $("#form_doctor").ajaxForm(optForm);
                $("#form_doctor").submit();

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

                    const { status, message, data } = await axios.post(appDomain + '/cms/doctor/delete/', bodyFormData).then(function (response) {

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

        clearImage: function (name) {
            this.models[name] = ''
            this.models[name + '_url'] = ''
        },

        resetFormData: function () {

            this.isEdit = false

            this.models = {
                id: '',
                foto: '',
                fullname: '',
                location: '',
                longitude: '',
                latitude: '',
                category_id: '',
                address: '',
                foto_url: '',
                phone_number: '',
                information: {
                    description: { "en": "", "id": "" }
                }
            }

            $('input[type=file]').val(null)
            $('#category_id').val('')
        }
    }

});