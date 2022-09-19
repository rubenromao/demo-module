<?php declare(strict_types=1);

namespace Macademy\Blog\ViewModel;

use Macademy\Blog\Api\Data\PostInterface;
use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Post implements ArgumentInterface
{
    public function __construct(
        private Collection $collection,
        private PostRepositoryInterface $postRepository,
        private RequestInterface $request,
    ) {}

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->collection->getItems();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->collection->count();
    }

    /**
     * @return PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getDetail(): PostInterface
    {
        $id = (int) $this->request->getParam('id');
        return $this->postRepository->getById($id);
    }
}
