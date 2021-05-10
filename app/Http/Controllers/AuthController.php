<?php

namespace App\Http\Controllers;
use Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsuariosRequest;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
     /* Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
  
    
    public function checkout()
    {
        
        
        
      $r = Request::all();
        return view('checkout')->with(['r'=>$r]);
    }
    
    
    public function profile()
    {
        
        return view('profile');
    }
    
    public function itens($id){
        
        $t = DB::table('transacoes_itens')->where(['id_trans'=>$id])->get();
        
        return view('itens')->with(['t'=>$t]);
    }
    
    public function transac()
    {
        
        
        //$produtos  = json_decode(Cookie::get('produtos'),true);
        
        //return Request::all();
        
        $user = DB::table('usuarios_site')
        ->select('id','name','idempresa','email','tipo_contato','telefone','tipo_endereco','cep','rua','numero','bairro','cidade','uf','cpf','ativo')
        ->where(['id'=>Auth::user()->id])
        ->get();
        
        $user[0]->telefone = str_replace(array('.','/','(',')','-',' '),'',$user[0]->telefone);
        
        if(empty($user[0]->cpf)){
            return redirect('/profile')->with('warning', 'O CPF esta em branco ou é invalido');
        }
        
        if(empty($user[0]->name)){
            return redirect('/profile')->with('warning', 'O Nome esta em branco ou é invalido');
        }
        
        if(empty($user[0]->telefone)){
            return redirect('/profile')->with('warning', 'O Telefone esta em branco ou é invalido');
        }
        
        
        
        /*
        if(empty( Request::input('formpgto'))){
            return redirect('/checkout')->with('warning', 'Escolha a forma de pagamento');
        }
        */
        
        if(empty( Request::input('cep'))){
            return redirect('/checkout')->with('warning', 'Sem endereço de entrega');
        }
        
        
        
        if(empty( Request::input('frete'))){
            return redirect('/checkout')->with('warning', 'Escolha o frete');
        }
        
        if(empty( Request::input('idloja'))){
            return redirect('/checkout')->with('warning', 'Sem produtos');
        }
        
      
        list ($frete, $valorfrete) = explode('|', Request::input('frete'));
        DB::beginTransaction();
        
        try {
            
            $id = DB::table('transacoes')->insertGetId([
               
                
                'idempresa'=> $user[0]->idempresa,
                'iduser'=> $user[0]->id,
                'formpgto'=>Request::input('formpgto'),
                'frete'=>$frete,
                'valorfrete'=>$valorfrete,
                'status'=>'A'
            ]);
            
            
            if(Request::input('cep')==0){
                DB::table('trasacoes_entrega')->insert([
                    
                    'idtrans'=>$id, 
                    'cep'=>$user[0]->cep, 
                    'endereco'=>$user[0]->rua, 
                    'numero'=>$user[0]->numero, 
                    'bairro'=>$user[0]->bairro, 
                    'cidade'=>$user[0]->cidade, 
                    'uf'=>$user[0]->uf, 
                    'nome'=>$user[0]->name, 
                    'telefone'=>$user[0]->telefone
                    
                ]);
            
            }
            
            
           
            $total = 0;
            $qtd = Request::input("qtd");
            foreach(Request::input('idloja') as $key  => $idloja){
                
                $loja = Db::table('loja')
                    ->where(['idloja'=>$idloja])
                    ->first();
                
                $produto = DB::table('produtos')
                    ->where(['id'=>$loja->idproduto])
                    ->first();
                
                
                $preco =  $loja->preco - ( $loja->preco * ($loja->desconto/100));
                
                
                
                //return var_dump($r99);
                DB::table('transacoes_itens')->insert([
                    'id_trans'=>$id,
                    'id_produto'=> $produto->id,
                    'description'=> $produto->descricao,
                    
                    'quantity'=>$qtd[$key],
                    'price_unit'=>round( $preco,2)
                ]);
                
                $total += round( ($preco*$qtd[$key]),2);
                
            }
            
            DB::table('transacoes')
            ->where('id',$id)
            ->update([
                'total'=>$total
            ]);
            
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            return $e;
            
        }
        // session(['produtos'  => null]);
        
        setcookie("produtos", "", time()-3600);
        setcookie("qtd", "", time()-3600);
        setcookie("valor", "", time()-3600);
        setcookie("total", "", time()-3600);
        
       
        return redirect()->away(Config::get('api.v1.micro') . '/paywithpaypal/' . $id);
       
    }
    
    
    public function updateprofile(UsuariosRequest $r)
    
    
    {
        DB::table('usuarios_site')
        ->where('id',Auth::user()->id)
        ->update([
            'name'=> Request::input('name'),
            'idempresa'=> Request::input('idempresa'),
            'tipo_contato'=> 'M',
            'telefone'=> Request::input('telefone'),
            'cep'=> str_replace(array('.','/','-'),'',Request::input('cep')),
            'rua'=> Request::input('rua'),
            'numero'=> Request::input('numero'),
            'bairro'=> Request::input('bairro'),
            'cidade'=> Request::input('cidade'),
            'uf'=> Request::input('uf')
            
        ]);
        
        
        if(Request::input('password')){
            DB::table('usuarios')
            ->where('id',Request::input('id'))
            ->update([
                
                'password'=> bcrypt(Request::input('password')),
                
            ]);
        }
        
        
        return redirect()->action('AuthController@profile')->with(['status'=>'Atualizado com sucesso']);
        
    }
}
