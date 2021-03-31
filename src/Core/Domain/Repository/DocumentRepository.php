<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use Doctrine\ODM\MongoDB\DocumentManager;

class DocumentRepository extends \Doctrine\ODM\MongoDB\Repository\DocumentRepository
{
    public function __construct(DocumentManager $dm, string $model)
    {
        $uow = $dm->getUnitOfWork();
        $classMetaData = $dm->getClassMetadata($model);
        parent::__construct($dm, $uow, $classMetaData);
    }
}
