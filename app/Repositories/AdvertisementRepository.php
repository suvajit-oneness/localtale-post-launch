<?php
namespace App\Repositories;

use App\Models\Advertisement;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\AdvertisementContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class AdvertisementRepository
 *
 * @package \App\Repositories
 */
class AdvertisementRepository extends BaseRepository implements AdvertisementContract
{
    use UploadAble;

    /**
     * AdvertisementRepository constructor.
     * @param Advertisement $model
     */
    public function __construct(Advertisement $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAdvertisements(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findAdvertisementById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findAdvertisementByBusiness(int $id)
    {
        try {
            return $this->model->where('business_id', $id)->get();

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Advertisement|mixed
     */
    public function createAdvertisement(array $params)
    {
        try {
            // dd($params);
            $collection = collect($params);

            $advertisement = new Advertisement;
            $advertisement->business_id = $collection['business_id'];
            $advertisement->title = $collection['title'];
            $advertisement->description = $collection['description'];
            $advertisement->page = $collection['page'];
            $advertisement->slot_id = $collection['slot_id'];
            $advertisement->redirect_link = $collection['redirect_link'];
            $advertisement->target_postcode = $collection['target_postcode'];
            $advertisement->target_city = $collection['target_city'];
            $advertisement->target_state = $collection['target_state'];
            $advertisement->click_count = 0;

            // image handling
            $image = $collection['image'];
            $imageName = time().".".$image->getClientOriginalName();
            $image->move("advertisements/",$imageName);
            $uploadedImage = $imageName;
            $advertisement->image = $uploadedImage;

            $advertisement->save();

            return $advertisement;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAdvertisement(array $params)
    {
        try {
            $advertisement = $this->findOneOrFail($params['id']);
            $collection = collect($params)->except('_token');
            // dd($collection);

            // $advertisement->title = $collection['title'];

            // $profile_image = $collection['image'];
            // $imageName = time().".".$profile_image->getClientOriginalName();
            // $profile_image->move("advertisements/",$imageName);
            // $uploadedImage = $imageName;
            // $advertisement->image = $uploadedImage;

            $advertisement->title = $collection['title'];
            $advertisement->description = $collection['description'];
            $advertisement->page = $collection['page'];
            $advertisement->slot_id = $collection['slot_id'];
            $advertisement->redirect_link = $collection['redirect_link'];
            $advertisement->target_postcode = $collection['target_postcode'];
            $advertisement->target_city = $collection['target_city'];
            $advertisement->target_state = $collection['target_state'];
            $advertisement->click_count = 0;

            // image handling
            if (isset($collection['image'])) {
                $image = $collection['image'];
                $imageName = time().".".$image->getClientOriginalName();
                $image->move("advertisements/",$imageName);
                $uploadedImage = $imageName;
                $advertisement->image = $uploadedImage;
            }

            $advertisement->save();

            return $advertisement;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteAdvertisement($id)
    {
        $advertisement = $this->findOneOrFail($id);
        $advertisement->delete();
        return $advertisement;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAdvertisementStatus(array $params){
        $advertisement = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $advertisement->status = $collection['check_status'];
        $advertisement->save();

        return $advertisement;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsAdvertisement($id)
    {
        $advertisements = Advertisement::with('deals')->with('events')->where('id',$id)->get();

        return $advertisements;
    }
}
