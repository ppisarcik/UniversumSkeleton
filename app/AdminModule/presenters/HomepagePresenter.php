<?php

namespace App\AdminModule\Presenters;

use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use Nette\DI\Container;

class HomepagePresenter extends BasePresenter
{
    /** @var CategoryRepository */
    public $categoryRepository;

    /**@var ArticleRepository */
    public $articleRepository;

    /** @var OrderRepository */
    private $orderRepository;

    /** @var Container */
    private $container;

    public function __construct
    (
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        OrderRepository $orderRepository,
        Container $container
    )
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->orderRepository = $orderRepository;
        $this->container = $container;
    }

    public function renderDefault()
	{
        $time = [];
        $time[] = $this->categoryRepository->getMaxValue('created_at');
        $time[] = $this->categoryRepository->getMaxValue('updated_at');
        $time[] = $this->categoryRepository->getMaxValue('deleted_at');
        $time[] = $this->articleRepository->getMaxValue('created_at');
        $time[] = $this->articleRepository->getMaxValue('updated_at');
        $time[] = $this->articleRepository->getMaxValue('deleted_at');
        $time[] = $this->orderRepository->getMaxValue('created_at');
        $time[] = $this->orderRepository->getMaxValue('updated_at');
        $this->template->time = $this->time_ago(max($time));

        $this->template->count = $this->getCount();


	}


    private function time_ago($date)
    {

        if (empty($date)) {
            return "No date provided";
        }
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        $now = time();
        $unix_date = strtotime($date);
        // check validity of date
        if (empty($unix_date)) {
            return "Bad date";
        }
        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "ago";
        } else {
            $difference = $unix_date - $now;
            $tense = "from now";
        }
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $periods[$j].= "s";
        }
        return "$difference $periods[$j]";
    }

    private function getCount()
    {
        $count = [];
        $containerParameters = $this->container->getParameters();

        foreach ($containerParameters['repositories'] as $repository) {
            $count[substr($repository, 0, -10)] = $this->container->getService($repository)->countRows('id');
        }

        $objectCount = $this->array_to_object($count);
        return $objectCount;
    }
    private function array_to_object($array) {
        return (object) $array;
    }

}
