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
            
            <form id="form_seo" class="form-horizontal form-label-left" action="{{ route('storeSeo') }}" method="POST" enctype="multipart/form-data" @submit.prevent>
                <div class="row">   
                    <div class="col-md-12" v-for="(lang, langKey) in supported_language"> 
                        
                        <div class="col-md-6 ">
                            <div class="form-group row">
                                <label :for="'meta_title_'+langKey">Meta Title (@{{lang.name}}) :</label>
                                <input type="text" :id="'meta_title_'+langKey" class="form-control" v-model="models.translations.meta_title[langKey]" :name="'meta_title['+langKey+']'">
                                <span class="text-error mt-2 d-block" :id="'field_meta_title_'+langKey"></span>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group row">
                                <label :for="'meta_keyword_'+langKey">Meta Keyword (@{{lang.name}}) :</label>
                                <input type="text" :id="'meta_keyword_'+langKey" class="form-control" v-model="models.translations.meta_keyword[langKey]" :name="'meta_keyword['+langKey+']'">
                                <span class="text-error mt-2 d-block" :id="'field_meta_keyword_'+langKey"></span>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group row">
                                <label :for="'meta_description_'+langKey">Meta Description (@{{lang.name}}) :</label>
                                <textarea class="form-control" v-model="models.translations.meta_description[langKey]" :name="'meta_description['+langKey+']'" :id="'meta_description_'+langKey" cols="30" rows="10"></textarea>
                                
                                <span class="text-error mt-2 d-block" :id="'field_meta_description_'+langKey"></span>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-md-12 mt-3">
                        <div class="ln_solid"></div>
                        {{ csrf_field() }}			
                        <input type="hidden" name="id" v-model="models.key_id" v-if="isEdit == true">
                        <button class="btn btn-primary f-right text-08rem" @click="saveData">Save</button>
                    </div>
                </div>
            </form>
            
        
        </div>
    </div>
</div>