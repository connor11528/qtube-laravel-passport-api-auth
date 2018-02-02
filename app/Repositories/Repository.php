<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository 
{
	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function all($columns = ['*'])
	{
		return $this->model->all($columns);
	}

	public function paginate($limit = null, $columns = ['*'])
	{
		return $this->model->paginate($limit, $columns);
	}

	public function find($id, $columns = ['*'])
	{
		return $this->model->findOrFail($id, $columns);
	}

	public function findByField($field, $value, $columns = ['*'])
	{
		return $this->model->where($field, $value)->get($columns);
	}

	public function findWhere($field, array $where, $columns = ['*'])
	{
		return $this->model->whereIn($field, $where)->get($columns);
	}

	public function findWhereNotIn($field, array $where, $columns = ['*'])
	{
		return $this->model->whereNotIn($field, $where)->get($columns);
	}

	public function create(array $attributes)
	{
		return $this->model->create($attributes);
	}

	public function update(array $attributes, $id)
	{
		$record = $this->find($id);
		return $record->update($attributes);
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

	/**
     * Eager load a relation
     *
     * @param mixed $relations
     * @return mixed
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
    
    /**
     * Get current model instance
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set model to work with
     *
     * @param mixed $model
     * @return Repository
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}