<?php


namespace App\Entity\Mail;


use App\Entity\BaseEntity;

class ExpertMailTemplate extends BaseEntity
{
    public string $name;

    public string $template;
}