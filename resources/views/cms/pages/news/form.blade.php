<div class="" id="form-open-content" style="display: none">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form News</h2>
            <div class="panel_toolbox">
                <button type="button" class="btn btn-secondary f-right text-08rem" @click="closeForm">Close</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            
            <form id="form_news" class="form-horizontal form-label-left" action="{{ route('storeNews') }}" method="POST" enctype="multipart/form-data" @submit.prevent>
                <div class="row">   
                    <template v-for="(lang, langKey) in supported_language">
                        <div class="col-md-6 ">
                            <div class="form-group row">
                                <label :for="'title_'+langKey">Title (@{{lang.name}}) :</label>
                                <input type="text" :id="'title_'+langKey" class="form-control" v-model="models.translations.title[langKey]" :name="'title['+langKey+']'">
                                <span class="text-error mt-2 d-block" :id="'field_title_'+langKey"></span>
                            </div>
                        </div>
                    </template>

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="category_id">Category :</label>
                            <select name="category_id" id="category_id" class="form-control" :selected="models.category_id">
                                <option value="">Choose One</option>
                                <option :value="category.id" v-for="(category, index) in listCategory">
                                    @{{ category.title }}
                                </option>
                            </select>
                            <span class="text-error mt-2 d-block" id="field_category_id"></span>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="doctor_id">Doctor (Optional) :</label>
                            <select name="doctor_id" id="doctor_id" class="form-control" :selected="models.doctor_id">
                                <option value="">Choose One</option>
                                <option :value="doctor.id" v-for="(doctor, index) in listDoctor">
                                    @{{ doctor.title }}
                                </option>
                            </select>
                            <span class="text-error mt-2 d-block" id="field_doctor_id"></span>
                        </div>
                    </div>

                    <div class="col-md-12 " v-if="isEdit == false">
                        <div class="form-group row">
                            <label for="tags_news" class="col-md-12">Input Tags</label>
                            <div class="col-md-12 " id="new_tag">
                                <input id="tags_news" type="text" class="tags form-control" name="tag_id" />
                                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 " v-if="isEdit == true">
                        <div class="form-group row">
                            <label for="tags_news_edit" class="col-md-12">Input Tags</label>
                            <div class="col-md-12">
                                <input id="tags_news_edit" type="text" class="tags form-control" name="tag_id" />
                                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                        <div class="form-group row">
                            <label for="home_thumbnail">Home Thumbnail : ( Width {{ HOME_THUMBNAIL_NEWS_IMAGE_WIDTH }}px and Height {{ HOME_THUMBNAIL_NEWS_IMAGE_HEIGHT }}px )</label>
                            <input type="file" id="home_thumbnail" name="home_thumbnail" class="form-control" placeholder="Click Here" @click="clearImage('home_thumbnail')">
                            <span class="d-block mt-2">@{{ models.home_thumbnail }}</span>
                            <span class="text-error mt-2 d-block" id="field_home_thumbnail"></span>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                        <div class="form-group row">
                            <label for="thumbnail">Thumbnail : ( Width {{ THUMBNAIL_NEWS_IMAGE_WIDTH }}px and Height {{ THUMBNAIL_NEWS_IMAGE_HEIGHT }}px )</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="form-control" placeholder="Click Here" @click="clearImage('thumbnail')">
                            <span class="d-block mt-2">@{{ models.thumbnail }}</span>
                            <span class="text-error mt-2 d-block" id="field_thumbnail"></span>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                        <div class="form-group row">
                            <label for="image">News Image : ( Width {{ NEWS_DETAIL_IMAGE_WIDTH }}px and Height {{ NEWS_DETAIL_IMAGE_HEIGHT }}px )</label>
                            <input type="file" id="image" name="image" class="form-control" placeholder="Click Here" @click="clearImage('image')">
                            <span class="d-block mt-2">@{{ models.image }}</span>
                            <span class="text-error mt-2 d-block" id="field_image"></span>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                        
                        @include('cms.partials.texteditor')
                        
                    </div>

                    @include('cms.partials.form-seo')
                    <div class="col-md-12 mt-3">
                        <div class="ln_solid"></div>
                        {{ csrf_field() }}			
                        <input type="hidden" name="class" value="News">
                        <input type="hidden" name="id" v-model="models.id" v-if="isEdit == true">
                        <input type="hidden" name="old_home_thumbnail" v-model="models.home_thumbnail" v-if="isEdit == true">
                        <input type="hidden" name="old_thumbnail" v-model="models.thumbnail" v-if="isEdit == true">
                        <input type="hidden" name="old_image" v-model="models.image" v-if="isEdit == true">
                        <button class="btn btn-primary f-right text-08rem" @click="saveData">Save</button>
                    </div>
                </div>
            </form>
            
        
        </div>
    </div>
</div>