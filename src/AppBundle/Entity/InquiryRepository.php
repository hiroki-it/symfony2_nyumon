<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * InquiryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InquiryRepository extends EntityRepository #リポジトリクラスに検索メソッドを用意
{
    public function findAllByKeyword($keyword) #キーワードに一致するお問い合わせ一覧を取得するfindAllByKeyword()を定義
    {
        $query = $this->createQueryBuilder('i')
            ->where('i.name LIKE :keyword') #LIKE検索
            ->orWhere('i.tel LIKE :keyword')
            ->orWhere('i.email LIKE :keyword')
            ->orderBy('i.id', 'DESC')
            ->setParameters([':keyword' => '%'.$keyword.'%']) #$keywordの前後は何でもよい
            ->getQuery();

        return new ArrayCollection($query->getResult());
    }
}
