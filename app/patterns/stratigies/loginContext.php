<?php

class LoginContext {
    private $strategy;

    // Set the login strategy dynamically
    public function setStrategy(LoginStrategy $strategy) {
        $this->strategy = $strategy;
    }

    // Execute the selected strategy's login method
    public function executeLogin($email, $password) {
        if ($this->strategy) {
            $this->strategy->login($email, $password);
        } else {
            throw new \Exception("No login strategy has been set!");
        }
    }
}