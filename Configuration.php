<?php
    final class Configuration {
        const BASE = 'http://localhost/project/';        
        
        const DATABASE_HOST = 'localhost';
        const DATABASE_USER = 'root';
        const DATABASE_PAWW = '';
        const DATABASE_NAME = 'shoe_catalogue_3';

        const SESSION_STORAGE = '\\App\\Core\\Session\\FileSessionStorage';
        const SESSION_STORAGE_DATA = [ './sessions/' ];
        const SESSION_LIFETIME = 3600;

        const FINGERPRINT_PROVIDER_FACTORY = '\\App\\Core\\Fingerprint\\BasicFingerprintProviderFactory';
        const FINGERPRINT_PROVIDER_METHOD = 'getInstance';
        const FINGERPRINT_PROVIDER_ARGS = [ 'SERVER' ];

        const UPLOAD_DIR = 'assets/uploads/';        
    }