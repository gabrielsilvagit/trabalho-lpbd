# trabalho-lpbd

Esse projeto foi realizado a 5 meses para um trabalho na faculdade, a documentação foi feita para o trabalho.
Hoje tenho mais conhecimento e experiência, acredito que meu código esteja bem melhor.
Qualquer dúvida, me chame no WhatsApp: (19) 983-168-060.
Obrigado desde já! 
Enjoy.

------------------------------------------------------------------------------------------------------------------------

Sistema de venda de serviços.
Integração de sistema em PHP com bando de dados em MySQL.


Nesse trabalho utilizaremos as linguagens passadas em sala de aula, PHP para o desenvolvimento do sistema e MySQL para o banco de dados.
Foi proposto um sistema de vendas de produtos e um sistema de venda de serviços, onde cada grupo poderia escolher entre os dois, escolhemos o sistema de venda de serviços pois em breves pesquisas foram encontrados poucos sistemas desse tipo, comparada com a quantidade de sites de venda de produtos, os e-commerce.
Para o desenvolvimento do sistema utilizaremos o Laravel, framework de PHP.
Laravel é um framework PHP livre e open-source criado por Taylor B. Otwell para o desenvolvimento de sistemas web que utilizam o padrão MVC (model, view, controller). Algumas características proeminentes do Laravel são sua sintaxe simples e concisa, um sistema modular com gerenciador de dependências dedicado, várias formas de acesso a banco de dados relacionais e vários utilitários indispensáveis no auxílio ao desenvolvimento e manutenção de sistemas.  
O projeto será desenvolvido seguindo o Design Pattern MVC, que o Laravel segue por padrão.
Design Pattern é uma forma padrão de organizar as classes e objetos, onde são compartilhados conhecimentos sobre orientação objeto aplicados a problemas que acontecem em diversos cenários de desenvolvimento de software.
MVC é o acrônimo de Model-View-Controller é um padrão de projeto de software, ou padrão de arquitetura de software formulado na década de 1970, focado no reuso de código e a separação de conceitos em três camadas interconectadas, onde a apresentação dos dados e interação dos usuários (front-end) são separados dos métodos que interagem com o banco de dados (back-end). 
 
Desenvolvimento

	Para o desenvolvimento desse projeto precisaremos ter um CRUD para usuários e serviços. CRUD é a abreviação para: Create, Red, Update e Delete.
CRUD de usuário
No nosso Controller de usuário, ( o C, do MVC), faremos os processos do CRUD.
	
Para o C(create), do nosso CRUD, temos nosso método “store”, onde recebemos os dados vindo da nossa view(o V, do MVC), que seria o formulário de criação de usuário, ao receber os dados, chamamos um outro método chamado “validateRequest”, que garante que todos os dados que foram recebidos são os que nosso “store” precisa.
	Logo após validarmos os dados, faremos o hash(encriptação) da password do usuário e utilizaremos a função “User::Create” passando os dados do usuário na variável $data, para fazer a criação do usuário, essa função já faz parte do Laravel, e por trás, ele envia os dados para o banco, fazendo toda a sintaxe para criar o usuário, sozinho.
Para o R(read), do nosso CRUD, temos nosso método “show”, onde pegamos todos os dados do usuário do nosso banco, e fazemos um inner join com a tabela de serviço para podemos retornar os serviços desse usuário.
	Para o U(update), do nosso CRUD, temos nosso método “update”, onde fazemos o mesmo tratamento dos dados recebidos da view, na função “validateRequest”, e depois utilizamos a função “$user->update” para atualizar aquele usuário, com os dados que estão da variável $data, por trás o laravel envia os dados para o banco, fazendo toda a sintaxe para atualizar o usuário, sozinho.
	



Para o D(delete), do nosso CRUD, temos nosso método “destroy”, onde utilizamos a função “$user->delete” para excluir o usuário, mas para excluirmos o usuário, precisamos excluir também todos os seus serviços.
    
    
```
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            Service::where("user_id", "=", $user->id)->delete();
            $user->delete();
            $this->showMessage("Usúario excluído com sucesso!");
            DB::commit();
            return redirect(route('login'));
        } catch(Exception $e) {
            $this->showMessage("Erro ao excluir usúario!", "error");
            return redirect()->back();
            DB::rollBack();
        }
    }
    
```

O Model, M do MVC, do nosso usuário ficou assim:

```
class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use SoftCascadeTrait;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $softCascade = ["service"];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function service()
    {
        return $this->belongsToMany('App\Service');
    }
}
```

Podemos ver que temos o relacionamento com a tabela de serviços, onde o usuário pode pertencer a muitos serviços( sendo cliente dos serviços ).

CRUD de serviços
	O CRUD de serviços é basicamente igual ao de usuário, mudando apenas os dados.
	Create:
  
 ```
public function store(Request $request, Service $service)
    {
        $request['user_id'] = Auth::user()->id;
        $data = $this->validateRequest($request);
        $service->create($data);
        $this->showMessage("Serviço salvo com sucesso!");
        return redirect()->route("service.show", $service);
    }
	
	validateRequest: 
    protected function validateRequest($request)
    {
        return $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'user_id' => 'sometimes|required',
        ],[
            "title.required" => "Titulo é obrigatório",
            "description.required" => "Descrição é obrigatório",
            "price.required" => "Preço é obrigatório"
        ]);
    }

	Show: 
    public function show(Service $service)
    {
        $customers = User::join("service_user as p", "p.user_id", "=", "users.id")
            ->join("services as s", "s.id","=","p.service_id")
            ->where("p.service_id", $service->id)
            ->select("users.*")
            ->whereNull("s.deleted_at")->paginate(50, ["*"], "customers");
        return view('services.show',compact('service','customers'));
    }

	


Update:
    public function update(Request $request, Service $service)
    {
        $data = $this->validateRequest($request);
        $service->update($data);
        $this->showMessage("Serviço salvo com sucesso!");
        return redirect()->route("service.show", $service);
    }

Delete:
    public function destroy(Service $service)
    {
        $service->delete();
        $this->showMessage("Serviço excluído com sucesso!");
        return redirect(route('show.user', $service->owner));
    }
```

Model do service:

```
class Service extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description','price' , 'user_id',
    ];

    public function owner()
    {
        return $this->hasOne("App\User", "id", "user_id");
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}
```

Podemos ver que temos duas relações com o usuário. 
Owner: todo serviço tem um dono, quem criou o serviço.
User: seria os clientes do serviço, o serviço pode ter muitos clientes(usuários).


Outros métodos e funções importantes
Para podermos acessar o sistema precisamos estar logados, para isso temos o método de login:

```
    public function loginPost(Request $request)
    {
        $data = $this->validateRequest($request);
        if(!Auth::attempt($data)) {
            return redirect()->route('login');
        }
        return redirect()->route('home');
    }
```

Onde também fazemos a validação dos dados, e utilizamos a função “Auth::attempt” para tentar fazer o login como os dados que foram passados. Essa função é própria do laravel, por tras, ele faz um select do usuário no banco de dados, e compara o email e a senha.
Para o logout do sistemas temos: 

```
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
```

	Utilizamos a função “Auth::logout” do próprio laravel para fazer o logout do sistema.
	Para podermos contratar um serviço utilizamos de uma tabela pivot que armaza o id do serviço e o id do usuário que está contratando o serviço, para podermos ter esse relacionamento:
    
```
    public function hire(Request $request, Service $service)
    {
        $user = Auth::user();
        $service->user()->attach($user);
        $this->showMessage("Serviço contratado com sucesso!");
        return redirect(route('service.show', $service));
    }
```

Onde damos um attach com o usuário que está contratando o serviço, ao relacionamento “$service->user”
	Agora, para descontratar um serviço, temos o contrário, em vez de attach, utilizamos o detach.
  
```
public function cancel(Service $service, User $user)
    {
        $service->user()->detach($user);
        $this->showMessage("Serviço cancelado com sucesso!");
        return redirect(route('service.show', $service));
    } 
O próprio Laravel faz a construção da sintaxes da criação do banco e das tabelas, através das migrations:
Usuário:
class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
Serviço:
class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->float('price');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->timestamps();
            $table->softDeletes();
Tabela pivô, relacionamento de cliente/serviço:
class CreateHiringsTable extends Migration
{
    public function up()
    {
        Schema::create('service_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('user_id')->references('id')->on('users');
        });

```

Conclusão
	
Por meio deste sistema, conseguimos concretizar os ensinamentos passados em sala de aula, fazendo uma integração entre o sistema em PHP e o banco em MySQL, podendo ter na pratica como funciona a utilização de um banco de dados, concluindo a atividade proposta pelo professor.
