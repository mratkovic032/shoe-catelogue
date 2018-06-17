<?php
    namespace App\Core;
    
    class DatabaseConfiguration {
        private $host;
        private $user;
        private $password;
        private $name;

        public function __construct(string $host, string $user, string $password, string $name) {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->name = $name;
        }

        public function getSourceString(): string {
            return "mysql:host={$this->host};dbname={$this->name};charset=utf8";
        }

        public function getUser(): string {
            return $this->user;
        }

        public function getPassword(): string {
            return $this->password;
        }
    }