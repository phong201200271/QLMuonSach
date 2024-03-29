<?php
namespace App\Repositories\Eloquent;
use App\Models\HistoryRentBook;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use mysql_xdevapi\Exception;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    public function getAllUser()
    {
        try {
            $user = $this->model->withCount([
                'historyRentBook as requestStatusPending' => function($query) {
                    $query->where('status',HistoryRentBook::statusPending);
                },
                'historyRentBook as requestStatusBorrowing' => function($query) {
                    $query->where('status',HistoryRentBook::statusBorrowing);
                },
                'historyRentBook as requestStatusReturned' => function($query) {
                    $query->where('status',HistoryRentBook::statusReturned);
                },
                'historyRentBook as requestStatusRefuse' => function($query) {
                    $query->where('status',HistoryRentBook::statusRefuse);
                }
            ])->paginate('10');
            return $user;
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function filterUser($arrFilter)
    {
        try {
            $user = $this->model->withCount([
                'historyRentBook as requestStatusPending' => function($query) {
                    $query->where('status',HistoryRentBook::statusPending);
                },
                'historyRentBook as requestStatusBorrowing' => function($query) {
                    $query->where('status',HistoryRentBook::statusBorrowing);
                },
                'historyRentBook as requestStatusReturned' => function($query) {
                    $query->where('status',HistoryRentBook::statusReturned);
                },
                'historyRentBook as requestStatusRefuse' => function($query) {
                    $query->where('status',HistoryRentBook::statusRefuse);
                }
            ])
                ->where('name','like','%'.$arrFilter['contentSearch'].'%')
                ->orWhere('mail','like','%'.$arrFilter['contentSearch'].'%')
                ->paginate('10');
            return $user;
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function countUser()
    {
        try {
            $countUser = $this->model->count();
            return $countUser;
        }catch (\Exception $e) {
            throw new Exception($e);
        }
    }

    public function getUserByToken($token)
    {
        try {
            $user = $this->model->where('remember_token',$token)->get();
            return $user;
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function getUserByMail($mail)
    {
        try {
            $user = $this->model->where('mail',$mail)->get();
            return $user;
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function getAllRequestRentBookExpirationOfUser()
    {
        try {
            $requestRentBook = $this->model
                ->whereHas('historyRentBook', function (Builder $query) {
                    $query->where('expiration_date', '<', now()->format('Y-m-d'))
                        ->where('status', 1);
                })
                ->with(['historyRentBook' => function ($query) {
                    $query->where('status', 1)
                        ->with(['detailHistoryRentBook', 'detailHistoryRentBook.book']);
                }])
                ->get();
            return $requestRentBook;
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
