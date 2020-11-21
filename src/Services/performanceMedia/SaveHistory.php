<?php


namespace App\Services\performanceMedia;


use App\Entity\History;
use Doctrine\ORM\EntityManagerInterface;

class SaveHistory
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $array
     * @return string
     */
    public function setHistoryList(array $array)
    {
        try{
            foreach($array as $key)
            {
                $listCurrency = new History();
                $singleObject = $this->createOrUpdata(
                    $listCurrency,
                    $key['title'],
                    $key['description'],
                    $key['summary'],
                    $key['gtin'],
                    $key['mpn'],
                    $key['price'],
                    $key['shortcode'],
                    $key['category'],
                    $key['sub'],
                    $key['date']
                );
                $this->em->persist($singleObject);

            }
            $this->em->flush();
            $message =  'The data has been saved';
        }catch (\Exception $e) {
            $message = sprintf('Exception [%i]: %s', $e->getCode(), $e->getMessage());
        }
        return $message;
    }

    /**
     * @param object $object
     * @param string $title
     * @param string $description
     * @param string $summary
     * @param string $gtin
     * @param string $mpn
     * @param string $price
     * @param string $shortcode
     * @param string $category
     * @param $sub
     * @param $date
     * @return object
     * @throws \Exception
     */
    private function createOrUpdata(object $object, string $title, string $description, string $summary, string $gtin, string $mpn, string $price, string $shortcode, string $category,  $sub, $date): object
    {

        $object->setTitle($title);
        $object->setDescription($description);
        $object->setSummary($summary);
        $object->setGtin($gtin);
        $object->setMpn($mpn);
        $object->setPrice($price);
        $object->setShortcode($shortcode);
        $object->setCategory($category);
        $object->setSub('');
        $object->setDate(new \DateTime($date));

        return $object;
    }
}