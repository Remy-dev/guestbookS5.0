<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateTimeFormat(DateTimeField::FORMAT_MEDIUM)
            ->setDefaultSort(['createdAt' => 'DESC']);

    }

    public function configureFields(string $pageName): iterable
    {
        return [
             TextField::new('author'),
             EmailField::new('email'),
             TextField::new('text'),
             ImageField::new('photoFilename')->setLabel('Photo')->setUploadDir('public/uploads/photos'),
             TextField::new('state')

        ];
    }
}
