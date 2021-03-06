<div class="" id="form-open-content" style="display: none">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form Banner</h2>
            <div class="panel_toolbox">
                <button type="button" class="btn btn-secondary f-right text-08rem" @click="closeForm">Close</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            
            <form id="form_banner" action="{{ route('storeBanner') }}" method="POST" enctype="multipart/form-data" @submit.prevent>
                <div class="row">   
                    <div class="col-md-6 " v-for="(lang, langKey) in supported_language">
                        <label :for="'title_'+langKey">Title (@{{lang.name}}) :</label>
                        <input type="text" :id="'title_'+langKey" class="form-control" v-model="models.translations.title[langKey]" :name="'title['+langKey+']'">
                        <span class="text-error mt-2 d-block" :id="'field_title_'+langKey"></span>
                    </div>
                    
                    <div class="col-md-6 mt-2">
                        
                        <label for="banner_image">Image : ( Width {{ HOME_BANNER_IMAGE_WIDTH }}px and Height {{ HOME_BANNER_IMAGE_HEIGHT }}px )</label>
                        <input type="file" id="banner_image" name="image" class="form-control" placeholder="Click Here" @click="clearImage">
                        <span class="d-block mt-2">@{{ models.image }}</span>
                        <span class="text-error mt-2 d-block" id="field_image"></span>
                        
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="ln_solid"></div>
                        {{ csrf_field() }}			
                        <input type="hidden" name="id" v-model="models.id" v-if="isEdit == true">
                        <input type="hidden" name="old_image" v-model="models.image" v-if="isEdit == true">
                        <button class="btn btn-primary f-right text-08rem" @click="saveData">Save</button>
                    </div>
                </div>
            </form>
            
        
        </div>
    </div>
</div>