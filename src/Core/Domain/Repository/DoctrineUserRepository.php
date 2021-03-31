<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\User;
use App\Core\Domain\ValueObject\Foundation\Error;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;

class DoctrineUserRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        parent::__construct($dm, User::class);
    }

    public function save(User $user): void
    {
        $this->getDocumentManager()->persist($user);

        try {
            $this->getDocumentManager()->flush();
        } catch (MongoDBException $e) {
            Error::create('Error during saving in database', 'mongo-error', [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
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
