const app = new Vue({

    el: '#newsManager',
    data: {

        models: {

            id: '',
            image: '',
            thumbnail: '',
            thumbnail_url: '',
            home_thumbnail: '',
            home_thumbnail_url: '',
            category_id: '',
            doctor_id: '',
            image_url: '',
            image_url: '',
            translations: {
                title: { "en": "", "id": "" },
                content: { "en": "", "id": "" },
            },
            tags: null
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
            }
        },
        type_seo: 'News',
        isEdit: false,
        listData: [],
        listDoctor: [],
        listCategory: [],
        supported_language: supported_language

    },

    mounted() {
        this.fetchData()
    },

    watch: {
        'models.tag': function () {
            console.log("runnn")
        }
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
                const { status, message, data } = await axios.get(appDomain + '/cms/news/data').then(function (response) {

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
                    vm.listData = data.news
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

                    const { status, message, data } = await axios.get(appDomain + '/cms/news/edit/' + id).then(function (response) {

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
                        for (var key in supported_language) {
                            $("#editor-one-" + key).html(vm.models.translations.content[key]);
                        }

                        $('.list_table').hide();
                        $('#form-open-content').slideDown('swing');
                        setTimeout(() => {
                            $("#tags_news_edit").tokenInput(appDomain + '/cms/tag/data?is_json=1', {
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
                        for (var key in vm.supported_language) {
                            editorObj[key] = $("#editor-one-" + key).html();
                            Vue.set(vm.models.translations.content, key, editorObj[key])
                            $('#descr_' + key).val(editorObj[key])
                        }
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
                $("#form_news").ajaxForm(optForm);
                $("#form_news").submit();

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

                    const { status, message, data } = await axios.post(appDomain + '/cms/news/delete/', bodyFormData).then(function (response) {

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
            var tagEdit = $("#tags_news_edit")
            var tagNew = document.createElement("input");
            $("#tags_news").remove();
            $('.token-input-list-facebook').remove();
            this.models = {
                id: '',
                image: '',
                thumbnail: '',
                thumbnail_url: '',
                home_thumbnail: '',
                home_thumbnail_url: '',
                category_id: '',
                doctor_id: '',
                image_url: '',
                image_url: '',
                translations: {
                    title: { "en": "", "id": "" },
                    content: { "en": "", "id": "" },
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
                }
            }

            this.type_seo = 'News'

            for (var key in supported_language) {
                $("#editor-one-" + key).html('');
                $('#descr_' + key).val('')
            }
            tagNew.setAttribute('id', 'tags_news')
            tagNew.setAttribute('name', 'tag')
            tagNew.setAttribute('class', 'tags form-control')
            console.log($(tagNew))
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
            $("#tags_news").tokenInput(appDomain + '/cms/tag/data?is_json=1', {
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