<?php

Route::get('/home', function() {
	return redirect(route('dashboard'));
});


Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'cms'], function () {

        Route::get('/dashboard', 'Cms\DashboardController@index')->name('dashboard');

        Route::group(['prefix' => 'banner'], function () {
            Route::get('/', 'Cms\BannerController@index')->name('indexBanner');
            Route::get('/data', 'Cms\BannerController@data')->name('dataBanner');
            Route::get('/edit/{id}', 'Cms\BannerController@edit')->name('editBanner');
            Route::post('/store', 'Cms\BannerController@store')->name('storeBanner');
            Route::post('/delete', 'Cms\BannerController@delete')->name('deleteBanner');
        });

        Route::group(['prefix' => 'news'], function () {
            Route::get('/', 'Cms\NewsController@index')->name('indexNews');
            Route::get('/data', 'Cms\NewsController@data')->name('dataNews');
            Route::get('/edit/{id}', 'Cms\NewsController@edit')->name('editNews');
            Route::post('/store', 'Cms\NewsController@store')->name('storeNews');
            Route::post('/delete', 'Cms\NewsController@delete')->name('deleteNews');
        });

        Route::group(['prefix' => 'video'], function () {
            Route::get('/', 'Cms\VideoController@index')->name('indexVideo');
            Route::get('/data', 'Cms\VideoController@data')->name('dataVideo');
            Route::get('/edit/{id}', 'Cms\VideoController@edit')->name('editVideo');
            Route::post('/store', 'Cms\VideoController@store')->name('storeVideo');
            Route::post('/delete', 'Cms\VideoController@delete')->name('deleteVideo');
        });
        
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', 'Cms\SeoController@index')->name('indexSeo');
            Route::get('/data', 'Cms\SeoController@data')->name('dataSeo');
            Route::get('/edit/{id}', 'Cms\SeoController@edit')->name('editSeo');
            Route::post('/store', 'Cms\SeoController@store')->name('storeSeo');
        });

        Route::group(['prefix' => 'tag'], function () {
            Route::get('/', 'Cms\TagController@index')->name('indexTag');
            Route::get('/data', 'Cms\TagController@data')->name('dataTag');
            Route::get('/edit/{id}', 'Cms\TagController@edit')->name('editTag');
            Route::post('/store', 'Cms\TagController@store')->name('storeTag');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'Cms\CategoryController@index')->name('indexCategory');
            Route::get('/data', 'Cms\CategoryController@data')->name('dataCategory');
            Route::get('/edit/{id}', 'Cms\CategoryController@edit')->name('editCategory');
            Route::post('/store', 'Cms\CategoryController@store')->name('storeCategory');
        });

        Route::group(['prefix' => 'doctor'], function () {
            Route::get('/', 'Cms\DoctorController@index')->name('indexDoctor');
            Route::get('/data', 'Cms\DoctorController@data')->name('dataDoctor');
            Route::get('/edit/{id}', 'Cms\DoctorController@edit')->name('editDoctor');
            Route::post('/store', 'Cms\DoctorController@store')->name('storeDoctor');
        });
    });
});
