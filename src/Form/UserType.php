<?php

namespace App\Form;

use App\Model\UserModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('email', EmailType::class, ["label" => "Email",
                "label_attr" => ["class" => "form-label mt-4"],
                "attr" => ["placeholder" => "Miam@gmail.com", "class" => "form-control relay-email-input-with-button-hovered"]])

            ->add("password", TextType::class, ["label" => "Mot de passe",
                "label_attr" => ["class" => "form-label mt-4"],
                "attr" => ["placeholder" => "UnMotDePasseSur1234!:", "class" => "form-control"],
                'help' => "Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial (?;!:=)"])

            ->add("confirmPassword", TextType::class, ["label" => "Confirmez votre mot de passe",
                "label_attr" => ["class" => "form-label mt-4"],
                "attr" => ["placeholder" => "UnMotDePasseSur1234!:", "class" => "form-control"]]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            "data_class" => UserModel::class
        ]);
    }
}
