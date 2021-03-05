<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\User;

class DoctrineUserRepository extends DocumentRepository
{
    public function __construct()
    {
        $documentManager = $this->getDocumentManager();
        $uow = $documentManager->getUnitOfWork();
        $classMetaData = $documentManager->getClassMetadata(User::class);
        parent::__construct($documentManager, $uow, $classMetaData);
    }

    public function save(User $user): void
    {
        $this->getDocumentManager()->persist($user);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function remove(User $user): void
    {
        $this->getDocumentManager()->remove($user);
    }
}
