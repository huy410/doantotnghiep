<?php 
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $User;
    public function __construct(User $User)
    {
        $this->User = $User;
    }

	public function getAll()
    {
		return $this->User->paginate(20);
	}

    public function getOne($id)
    {
        return $this->User->findOrFail($id);
    }

	public function create($request)
    {
        return $this->User->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function update($request, $id)
    {
       $this->User->find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function delete($id)
    {
		return $this->User->destroy($id);
	}

    public function search($request)
    {
		return $this->User->where('email', 'like', '%'.$request->search.'%')->paginate(20);
	}

    public function selectEmail($request)
    {
        return User::where('email', $request->email)->first(); 
    }
}