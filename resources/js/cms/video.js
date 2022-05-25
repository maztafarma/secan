const app = new Vue({

    el: '#videoManager',
    data: {

        models: {

            id: '',
            thumbnail: '',
            thumbnail_url: '',
            home_thumbnail: '',
            home_thumbnail_url: '',
            category_id: '',
            doctor_id: '',
            youtube_url: '',
            translations: {
                title: { "en": "", "id": "" }
            }
        },

        seo: {

            id: '',
            title: '',
            keyword: '',
            description: '',
            translations: {

                meta_title: { 'en': '', 'id': '' },
                meta_keyword: { 'en': '', 'id': '' },
                meta_description: { 'en': '', 'id': '' },
            },
            tags: null
        },
        type_seo: 'Video',
        isEdit: false,
        listData: [],
        listDoctor: [],
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
                const { status, message, data } = await axios.get(appDomain + '/cms/video/data').then(function (response) {

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
                    vm.listData = data.video
                    vm.listDoctor = data.doctor
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

                    const { status, message, data } = await axios.get(appDomain + '/cms/video/edit/' + id).then(function (response) {

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
                        vm.models = data.data
                        vm.seo = data.seo
                        $('#category_id').val(vm.models.category_id)
                        $('#doctor_id').val(vm.models.doctor_id)

                        $('.list_table').hide();
                        $('#form-open-content').slideDown('swing');
                        setTimeout(() => {
                            $("#tags_video_edit").tokenInput(appDomain + '/cms/tag/data?is_json=1', {
                                theme: "facebook",
                                queryParam: 'tag',
                                hintText: 'Type here ..',
                                noResultsText: 'Tag not found ..',
                                searchingText: 'Searching tag ..',
                                preventDuplicates: true,
                                searchDelay: 2000,
                                minChars: 3,
                                propertyToSearch: 'title',
                                prePopulate: data.data.tags,
                                animateDropdown: true,
                                hintShowData: true,

                                onAdd: function (item) {

                                },
                                onDelete: function (item) {

                                },
                                resultsFormatter: function (item) { return "<li><div style='display: inline-block; padding-left: 6px;'><div class='full_name'>" + item.title + " </div></div></li>" },
                                tokenFormatter: function (item) { return "<li><p>" + item.title + "</p></li>" }
                            });
                        }, 1000);
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
                $("#form_video").ajaxForm(optForm);
                $("#form_video").submit();

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

                    const { status, message, data } = await axios.post(appDomain + '/cms/video/delete/', bodyFormData).then(function (response) {

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
            var tagEdit = $("#tags_video_edit")
            var tagNew = document.createElement("input");
            $("#tags_video").remove();
            $('.token-input-list-facebook').remove();

            this.models = {
                id: '',
                thumbnail: '',
                thumbnail_url: '',
                home_thumbnail: '',
                home_thumbnail_url: '',
                category_id: '',
                doctor_id: '',
                youtube_url: '',
                translations: {
                    title: { "en": "", "id": "" },
                },
                tags: null
            }

            this.seo = {

                id: '',
                title: '',
                keyword: '',
                description: '',
                translations: {

                    meta_title: { 'en': '', 'id': '' },
                    meta_keyword: { 'en': '', 'id': '' },
                    meta_description: { 'en': '', 'id': '' },
                },
                tags: null
            }

            this.type_seo = 'Video'

            tagNew.setAttribute('id', 'tags_video')
            tagNew.setAttribute('name', 'tag')
            tagNew.setAttribute('class', 'tags form-control')

            $("#new_tag").append(tagNew);

            if ($(tagNew).length <= 1)
                this.initTagging()

            if (tagEdit.length)
                tagEdit.tokenInput("clear");

            $('input[type=file]').val(null)
            $('#category_id').val('')
            $('#doctor_id').val('')
        },

        initTagging: function () {

            let self = this
            $("#tags_video").tokenInput(appDomain + '/cms/tag/data?is_json=1', {
                theme: "facebook",
                queryParam: 'tag',
                hintText: 'Type here ..',
                noResultsText: 'Tag not found ..',
                searchingText: 'Searching tag ..',
                preventDuplicates: true,
                searchDelay: 2000,
                minChars: 3,
                propertyToSearch: 'title',
                animateDropdown: true,
                hintShowData: true,

                onAdd: function (item) {

                },
                onDelete: function (item) {

                },
                resultsFormatter: function (item) { return "<li><div style='display: inline-block; padding-left: 6px;'><div class='full_name'>" + item.title + " </div></div></li>" },
                tokenFormatter: function (item) { return "<li><p>" + item.title + "</p></li>" }
            });
        }
    }

});