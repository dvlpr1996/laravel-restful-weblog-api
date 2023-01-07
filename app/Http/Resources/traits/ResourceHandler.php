<?php

namespace App\Http\Resources\traits;

trait ResourceHandler
{
    private $model;
    private $resource;
    private $collection;

    private function  setModelNameSpace(string $modelName)
    {
        $this->model = 'App\Models\\' . ucfirst($modelName);
    }

    private function  setResourceNameSpace(string $modelName)
    {
        $this->resource = 'App\Http\Resources\\' . ucfirst($modelName . 'resource');
    }

    private function  setResourceCollectionNameSpace(string $modelName)
    {
        $this->collection = 'App\Http\Resources\\' . ucfirst($modelName . 'collection');
    }

    protected function resourceHandlerTraitNameSpaceSetter(string $resourceName)
    {
        $this->setModelNameSpace($resourceName);
        $this->setResourceNameSpace($resourceName);
        $this->setResourceCollectionNameSpace($resourceName);
    }

    protected function isIdRequest(string $data): bool
    {
        if (is_numeric($data) && preg_match('/^\d+$/', $data))
            return true;
        return false;
    }

    protected function isSlugRequest(string $data): bool
    {
        if (is_string($data) && preg_match('/[-a-zA-Z]+/', $data))
            return true;
        return false;
    }

    protected function getDataById(string $param)
    {
        return $this->showApiDataResource($this->model::findOrFail($param));
    }

    protected function getDataBySlug(string $param)
    {
        return $this->showApiDataResource($this->model::where('slug', $param)->firstOrFail());
    }

    protected function showApiData(string $param)
    {
        $param = trim($param);

        if ($this->isIdRequest($param))
            return $this->getDataById($param);

        if ($this->isSlugRequest($param))
            return $this->getDataBySlug($param);
    }

    protected function showApiDataCollection($resource)
    {
        return new $this->collection($resource);
    }

    protected function showApiDataResource($resource)
    {
        return new $this->resource($resource);
    }

    protected function showApiDataCollectionWithPagination(bool $isAll = false)
    {
        ($isAll) ? $isAll = $this->model::all() : $isAll = $this->model::paginate(10)->withQueryString();
        return new $this->collection($isAll);
    }
}
