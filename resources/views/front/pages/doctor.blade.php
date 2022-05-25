@extends('front.layout.master')
@section('content')


<section id="frontDoctor" class="pb-5 pt-3">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <h1 class="text-left text-capitalize mb-5 text-md">
                    Dokter
                </h1>
                
                <p class="text-capitalize bredcrumb">
                    <a href="{{ route('frontHome') }}">
                        <i class="fa fa-home mr-2"></i>beranda
                    </a> / 
                    
                    <a href="{{ route('frontDoctor') }}">
                        dokter
                    </a> / 
                    
                    <a href="#">
                        direktori
                    </a>
                </p>
                <br />

                @include('front.partials.menu-doctor')
                
            </div>
            
            <div class="col-md-9 mb-3 mb-lg-5">
                <div class="row">
                    <div class="col-md-3 mb-5" v-for="(doctor, index) in listDoctor">
                        <a href="javascript:void(0)" class="view_doctor_detail" @click="showDetail(index)">
                            <img :src="doctor.foto_url" class="full-width" />
                            <h3 class="mt-3 text-base text-center">
                            @{{ doctor.fullname }}
                            </h3>
                            <p class="mt-2 mb-2 text-center">
                                <span class="text-capitalize text-sm">@{{ doctor.location }}</span>
                            </p>
                            <p class="mt-2 mb-2 text-center">
                                <span class="text-capitalize text-sm">@{{ doctor.total_artikel }} artikel</span>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3 mb-lg-5">
                <div class="mb-5">
                    <p class="text-uppercase text-left mb-3">
                        <h6>URUTKAN</h6>
                    </p>
                    <select class="form-control" @change="filter($event)">
                        <option value="name">Nama A - Z</option>
                        <option value="kecantikan">Dokter Kecantikan</option>
                        <option value="kesehatan">Dokter Kesehatan</option>
                        <option value="area">Area</option>
                    </select>
                </div>
                
                <div class="" v-if="detail.fullname !== ''">
                    <img :src="detail.foto_url" class="full-width" />
                    <h3 class="mt-3 text-base text-center">@{{ detail.fullname }}</h3>
                    <p class="mt-2 mb-2 text-justify">
                        <span class="text-capitalize text-sm" v-html>
                            @{{ detail.description }}
                        </span>
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8460094174375!2d106.69294269999999!3d-6.151372299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMDknMDQuOSJTIDEwNsKwNDEnMzQuNiJF!5e0!3m2!1sid!2sid!4v1612775982634!5m2!1sid!2sid" width="250" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    <br><a target="__blank" :href="'https://www.google.com/maps/search/?api=1&query='+detail.latitude+','+detail.longitude" class="text-sm">Lihat peta</a></br>
                </div>
                
            </div>

        </div>
    </div>
</section>
@stop


@section('scripts')

<script>

    var frontDoctor = new Vue({

        el: "#frontDoctor",
        data: {

            detail: {
                fullname: '',
                address: '',
                category_name: '',
                category_slug: '',
                description: '',
                foto_url: '',
                location: '',
                latitude: '',
                longitude: '',
                phone_number: '',
                total_artikel: ''
            },
            
            listDoctor: []
        },

        mounted() {
            this.filter()
        },

        methods: {

            filter: function(event) {
                console.log(event)
                let qString = ''
                let param = event ? event.target.value : 'name'
                
                switch (param) {
                    case 'kecantikan':
                        qString = '?category_slug='+param
                        break;
                    case 'kesehatan':
                        qString = '?category_slug='+param
                        break;
                    case 'name':
                        qString = '?filter=name'
                        break;
                    case 'area':
                        qString = '?filter=area'
                        break;
                
                    default:
                        qString = '?filter=name'
                        break;
                }

                this.fetchDoctor(qString)
            },

            fetchDoctor: function (params) {

                var vm = this;


                (async () => {
                    const { status, message, data } = await axios.get(appDomain + '/dokter/data'+params).then(function (response) {

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
                    
                    vm.listDoctor = data.doctor
                })()
            },

            showDetail: function(index) {
                
                try {
                    
                    this.detail = this.listDoctor[index]
                } catch (error) {
                    
                }
            }
        }
            
    });
</script>

@stop