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
            
            <form id="form_doctor" class="form-horizontal form-label-left" action="{{ route('storeDoctor') }}" method="POST" enctype="multipart/form-data" @submit.prevent>
                <div class="row">   
                    
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
                    
                </div>
                <div class="row">  
                    <div class="col-md-6 mt-2">
                        <div class="form-group row">
                            <label for="foto">Foto : ( Width {{ DOCTOR_IMAGE_WIDTH }}px and Height {{ DOCTOR_IMAGE_HEIGHT }}px )</label>
                            <input type="file" id="foto" name="foto" class="form-control" placeholder="Click Here" @click="clearImage('foto')">
                            <span class="d-block mt-2">@{{ models.foto }}</span>
                            <span class="text-error mt-2 d-block" id="field_foto"></span>
                            
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="fullname">fullname :</label>
                            <input  id="fullname" class="form-control" v-model="models.fullname" name="fullname"></input>
                            <span class="text-error mt-2 d-block" id="field_fullname"></span>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="location">location :</label>
                            <input  id="location" class="form-control" v-model="models.location" name="location"></input>
                            <span class="text-error mt-2 d-block" id="field_location"></span>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="longitude">Longitude :</label>
                            <input  id="longitude" class="form-control" v-model="models.longitude" name="longitude"></input>
                            <span class="text-error mt-2 d-block" id="field_longitude"></span>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="latitude">Latitude :</label>
                            <input  id="latitude" class="form-control" v-model="models.latitude" name="latitude"></input>
                            <span class="text-error mt-2 d-block" id="field_latitude"></span>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="phone_number">Phone Number :</label>
                            <input  id="phone_number" type="number" class="form-control" v-model="models.phone_number" name="phone_number"></input>
                            <span class="text-error mt-2 d-block" id="field_phone_number"></span>
                        </div>
                    </div>
                </div>
                <div class="row">  

                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label for="address">Address :</label>
                            <textarea  id="address" class="form-control" v-model="models.address" name="address" cols="30" rows="10"></textarea>
                            <span class="text-error mt-2 d-block" id="field_address"></span>
                        </div>
                    </div>
                </div>
                <div class="row">  

                    <template v-for="(lang, langKey) in supported_language">
                        <div class="col-md-6 ">
                            <div class="form-group row">
                                <label :for="'description_'+langKey">Information (@{{lang.name}}) :</label>
                                <textarea  :id="'description_'+langKey" class="form-control" v-model="models.information.description[langKey]" :name="'description['+langKey+']'" cols="30" rows="10"></textarea>
                                <span class="text-error mt-2 d-block" :id="'field_description_'+langKey"></span>
                            </div>
                        </div>
                    </template>

                    <div class="col-md-12 mt-3">
                        <div class="ln_solid"></div>
                        {{ csrf_field() }}			
                        <input type="hidden" name="id" v-model="models.id" v-if="isEdit == true">
                        <input type="hidden" name="old_foto" v-model="models.foto" v-if="isEdit == true">
                        <button class="btn btn-primary f-right text-08rem" @click="saveData">Save</button>
                    </div>
                </div>
            </form>
            
        
        </div>
    </div>
</div>