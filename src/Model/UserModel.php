<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class UserModel {
    #[Assert\Email(message: "L'email {{ value }} n'est pas valide")]
    #[Assert\NotBlank(message: "L'email est obligatoire")]
    public ?string $email;
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire")]
    #[Assert\Regex(pattern: '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[:?!;=]).*$/', message: "Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial (?;!:=)")]
    #[Assert\Expression("this.password == this.confirmPassword", message: "Les mots de passe ne correspondent pas")]
    public ?string $password;
    #[Assert\NotBlank(message: "Veuillez confirmer le mot de passe")]
    public ?string $confirmPassword;

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getConfirmPassword(): ?string {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(?string $confirmPassword): void {
        $this->confirmPassword = $confirmPassword;
    }
}