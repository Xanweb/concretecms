<?php

namespace Concrete\Core\Navigation;

use Concrete\Core\Navigation\Item\ItemInterface;
use JsonSerializable;

class Navigation implements NavigationInterface, JsonSerializable
{
    /**
     * @var \Concrete\Core\Navigation\Item\ItemInterface[]
     */
    protected $items = [];

    public function __clone()
    {
        $items = $this->getItems();
        $this->setItems([]);
        foreach ($items as $item) {
            $this->add(clone $item);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \Concrete\Core\Navigation\NavigationInterface::add()
     */
    public function add(ItemInterface $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Returns all the items in the navigation.
     *
     * @return \Concrete\Core\Navigation\Item\ItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param \Concrete\Core\Navigation\Item\ItemInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @see \JsonSerializable::jsonSerialize()
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $data = [];
        foreach ($this->getItems() as $item) {
            $data[] = $item->jsonSerialize();
        }

        return $data;
    }
}
