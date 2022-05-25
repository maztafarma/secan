<div class="row">   
    <div class="col-md-12" v-for="(lang, langKey) in supported_language"> 
        
        <p class="m-3 text-md" v-if="langKey == 'id'"><b>Seo</b></p>
        <div class="col-md-6 ">
            <div class="form-group row">
                <label :for="'meta_title_'+langKey">Meta Title (@{{lang.name}}) :</label>
                <input type="text" :id="'meta_title_'+langKey" class="form-control" v-model="seo.translations.meta_title[langKey]" :name="'seo[meta_title]['+langKey+']'">
                <span class="text-error mt-2 d-block" :id="'field_meta_title_'+langKey"></span>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="form-group row">
                <label :for="'meta_keyword_'+langKey">Meta Keyword (@{{lang.name}}) :</label>
                <input type="text" :id="'meta_keyword_'+langKey" class="form-control" v-model="seo.translations.meta_keyword[langKey]" :name="'seo[meta_keyword]['+langKey+']'">
                <span class="text-error mt-2 d-block" :id="'field_meta_keyword_'+langKey"></span>
            </div>
        </div>

        <div class="col-md-12 ">
            <div class="form-group row">
                <label :for="'meta_description_'+langKey">Meta Description (@{{lang.name}}) :</label>
                <textarea class="form-control" v-model="seo.translations.meta_description[langKey]" :name="'seo[meta_description]['+langKey+']'" :id="'meta_description_'+langKey" cols="30" rows="10"></textarea>
                
                <span class="text-error mt-2 d-block" :id="'field_meta_description_'+langKey"></span>
            </div>
        </div>
    </div>
    <input type="hidden" name="seo[type_seo]" id="seo_type" v-model="type_seo">
</div>
