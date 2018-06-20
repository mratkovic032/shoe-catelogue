<?php
    return [
        # Admin login/register routes:
        # App\Core\Route::get('|^admin/register/?$|',                 'Main',                         'getRegister'),
        # App\Core\Route::post('|^admin/register/?$|',                'Main',                         'postRegister'),
        App\Core\Route::get('|^admin/login/?$|',                    'Main',                         'getLogin'),
        App\Core\Route::post('|^admin/login/?$|',                   'Main',                         'postLogin'),
        App\Core\Route::get('|^admin/logout/?$|',                   'Main',                         'getLogout'),        

        # Guest role routes:
        App\Core\Route::get('|^category/([0-9]+/?)$|',                  'Category',                     'show'),
        App\Core\Route::get('|^product/([0-9]+/?)$|',                   'Product',                      'show'),
        App\Core\Route::get('|^category/([0-9]+)/brand/([0-9]+/?)$|',   'Brand',                        'show'),        

        # Admin role routes:
            App\Core\Route::get('|^admin/dashboard/?$|',                        'AdminDashboard',               'index'),
            App\Core\Route::get('|^admin/profile/?$|',                          'AdminDashboard',               'profile'),

            # Products        
            App\Core\Route::get('|^admin/products/?$|',                         'AdminProductMenagement',       'products'),
            App\Core\Route::get('|^admin/products/edit/([0-9]+)/?$|',           'AdminProductMenagement',       'getProductEdit'),
            App\Core\Route::post('|^admin/products/edit/([0-9]+)/?$|',          'AdminProductMenagement',       'postProductEdit'),
            App\Core\Route::get('|^admin/products/add/?$|',                     'AdminProductMenagement',       'getProductAdd'),
            App\Core\Route::post('|^admin/products/add/?$|',                    'AdminProductMenagement',       'postProductAdd'),        

            # Product Version
            App\Core\Route::get('|^admin/products/stock/([0-9]+)/?$|',                  'AdminProductMenagement',       'stock'),
            App\Core\Route::get('|^admin/products/stock/([0-9]+)/delete/([0-9]+)/?$|',  'AdminProductMenagement',       'deleteStock'),  
            App\Core\Route::get('|^admin/products/stock/add/([0-9]+)/?$|',              'AdminProductMenagement',       'getStockAdd'),
            App\Core\Route::post('|^admin/products/stock/add/([0-9]+)/?$|',             'AdminProductMenagement',       'postStockAdd'),
            App\Core\Route::get('|^admin/products/stock/edit/([0-9]+)/?$|',             'AdminProductMenagement',       'getStockEdit'),
            App\Core\Route::post('|^admin/products/stock/edit/([0-9]+)/?$|',            'AdminProductMenagement',       'postStockEdit'),

            # Categories
            App\Core\Route::get('|^admin/categories/?$|',                       'AdminCategoryMenagement',       'categories'),
            App\Core\Route::get('|^admin/categories/delete/([0-9]+)/?$|',       'AdminCategoryMenagement',       'delete'),
            App\Core\Route::get('|^admin/categories/edit/([0-9]+)/?$|',         'AdminCategoryMenagement',       'getEdit'),
            App\Core\Route::post('|^admin/categories/edit/([0-9]+)/?$|',        'AdminCategoryMenagement',       'postEdit'),
            App\Core\Route::get('|^admin/categories/add/?$|',                   'AdminCategoryMenagement',       'getAdd'),
            App\Core\Route::post('|^admin/categories/add/?$|',                  'AdminCategoryMenagement',       'postAdd'),

            # Brands
            App\Core\Route::get('|^admin/brands/?$|',                           'AdminBrandMenagement',       'brands'),
            App\Core\Route::get('|^admin/brands/delete/([0-9]+)/?$|',           'AdminBrandMenagement',       'delete'),  
            App\Core\Route::get('|^admin/brands/edit/([0-9]+)/?$|',             'AdminBrandMenagement',       'getEdit'),
            App\Core\Route::post('|^admin/brands/edit/([0-9]+)/?$|',            'AdminBrandMenagement',       'postEdit'),
            App\Core\Route::get('|^admin/brands/add/?$|',                       'AdminBrandMenagement',       'getAdd'),
            App\Core\Route::post('|^admin/brands/add/?$|',                      'AdminBrandMenagement',       'postAdd'),

            # Colors
            App\Core\Route::get('|^admin/colors/?$|',                           'AdminColorMenagement',       'colors'),
            App\Core\Route::get('|^admin/colors/delete/([0-9]+)/?$|',           'AdminColorMenagement',       'delete'),
            App\Core\Route::get('|^admin/colors/edit/([0-9]+)/?$|',             'AdminColorMenagement',       'getEdit'),
            App\Core\Route::post('|^admin/colors/edit/([0-9]+)/?$|',            'AdminColorMenagement',       'postEdit'),
            App\Core\Route::get('|^admin/colors/add/?$|',                       'AdminColorMenagement',       'getAdd'),
            App\Core\Route::post('|^admin/colors/add/?$|',                      'AdminColorMenagement',       'postAdd'),

            # Sizes
            App\Core\Route::get('|^admin/sizes/?$|',                            'AdminSizeMenagement',       'sizes'),
            App\Core\Route::get('|^admin/sizes/delete/([0-9]+)/?$|',            'AdminSizeMenagement',       'delete'),
            App\Core\Route::get('|^admin/sizes/edit/([0-9]+)/?$|',              'AdminSizeMenagement',       'getEdit'),
            App\Core\Route::post('|^admin/sizes/edit/([0-9]+)/?$|',             'AdminSizeMenagement',       'postEdit'),
            App\Core\Route::get('|^admin/sizes/add/?$|',                        'AdminSizeMenagement',       'getAdd'),
            App\Core\Route::post('|^admin/sizes/add/?$|',                       'AdminSizeMenagement',       'postAdd'),

        # API routes:

            # Bookmarks:
            App\Core\Route::get('|^api/product/([0-9]+)/?$|',           'ApiProduct',                   'show'),
            App\Core\Route::get('|^api/bookmarks/?$|',                  'ApiBookmark',                  'getBookmarks'),
            App\Core\Route::get('|^api/bookmarks/add/([0-9]+)/?$|',     'ApiBookmark',                  'addBookmark'),
            App\Core\Route::get('|^api/bookmarks/clear/?$|',            'ApiBookmark',                  'clear'),

            # Color:
            App\Core\Route::get('|^api/color/?$|',                       'ApiColor',                  'getColors'),
            App\Core\Route::get('|^api/color/add/([A-Z][a-z]+)/?$|',     'ApiColor',                  'addColor'),

            # Size:
            App\Core\Route::get('|^api/size/?$|',                        'ApiSize',                  'getSizes'),
            App\Core\Route::get('|^api/size/add/([0-9]+)/?$|',           'ApiSize',                  'addSize'),

        # Search:
        App\Core\Route::post('|^search/?$|',                             'Search',                  'quickSearch'),

        App\Core\Route::any('|^.*$|',                               'Main',                         'home')
    ];