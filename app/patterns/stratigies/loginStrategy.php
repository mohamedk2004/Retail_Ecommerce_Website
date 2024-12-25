<?php

interface LoginStrategy {
    public function handleLogin(string $email, string $password): void;
}