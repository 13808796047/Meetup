使用 mac 做开发，有一些 app 几乎做任何程序开发都必备的。

xcode
mac中有太多开发相关的程序，都依赖于xcode。所以无论你做不做ios开发，基本都是必须安装的。安装也非常简单，直接在app store中下载就好了。需要注意的是，当安装完成之后，一定记得要启动一次，并点击同意按钮。

oh my zsh
http://ohmyz.sh



这是一个命令行增强工具，它提供各种美观的主题，还有各种各样对开发有帮助的插件，包括对php和laravel都有相关的插件支持。总之非常推荐安装一下了，我们后面的教程也都会使用它。

一条命令来搞定它~

sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
homebrew


https://brew.sh

假如你之前用过linux系统。那么在ubuntu上安装程序，经常会使用一个叫做apt的命令。在centos上，也有一个类似的yum命令。
如果你喜欢这个功能，那么就一定要来试试homebrew了。

同样一条命令搞定它。

/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
使用的方法也非常简单，想安什么就直接brew install吧。

brew install wget
php
有了上面这些工具后，再来安装一下php。现在我们使用的laravel 5.5版本，最低要求的php版本都是7以上，所以我们直接来安装最新的php 7.2好了。

brew install php72
Tips: 现在已经不需要再设置环境变量了，你只需重启下命令行，如果出现 php 7.2.x那就是成功

php -v
which php
安装composer


composer是 php 的包管理器，也是类似homebrew的功能，不同的是 composer 是专门用来安装 php 包的。在开发 php 程序时，想安装什么，都是一条composer require，就可以自动下载好你想要的包了。

curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer 默认的仓库在国外，用起来非常的慢。那么就修改为使用中国镜像，这样下载包的时候速度就会很快了。

composer config -g repo.packagist composer https://packagist.phpcomposer.com
mysql
最后来安装一个mysql数据库，到后面我们再学习数据库到底是怎么玩的。

brew install mysql
装完后，通过下面这条命令来启动mysql

# 这条命令跑完后，每次开机都会自动运行mysql
brew services start mysql

# 如果你不需要开机自动运行，你可以用下面这条命令
mysql.server start
Tips: mysql默认的账号是root，密码是空。

跑起一个laravel项目来
先使用composer安装 laravel安装器

composer global require "laravel/installer"
装完后，要来修改一下oh my zsh的环境变量

export PATH=~/.composer/vendor/bin:$PATH
改完后，记得要重启一下终端。

建一个专门放php项目的目录

mkdir -p  ~/Developer/PHP
cd ~/Developer/PHP
再来建一个laravel项目，并启动服务。

laravel new meetup
cd meetup
php artisan serve
现在就可以用浏览器来访问了

http://localhost:8000
great，一个laravel项目已经成功跑起来了。

# 笔记一
开发 web 应用是个复杂的过程，同一个功能实现方式很多，其实有时候仅仅是选择太多，就是把新手搞晕的一个重要原因。
这个问题在php的世界中尤其严重，实在是有太多的技术栈，太多不同的框架供你选择了。
laravel 有从rails那里借鉴来的一套 最优的做法，这就是 The Laravel Way 。

The Laravel Way


laravel 的根本骨架是上面的 mvc 结构，不过这一集只来关注 route -> controller -> view 的这条线。

到 routes/web.php 中修改

Route::get('/', 'WelcomeController@index');
Route::get('about', 'WelcomeController@about');
添加 controller
php artisan make:controller WelcomeController
Tips: windows用户，直接点击laragon的终端打开cmder，再来打命令就好。还要确认命令行所在的路径是项目路径，如果路径不对，你需要先使用cd命令进入对应的目录，例如cd meetup。

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome.index');
    }

    public function about()
    {
        return view('welcome.about');
    }
}
接下来，就要来添加html模板了。

views
到 https://github.com/AaronRyuu/laravel_meetup/tree/html中下载提供的静态模板。
将提供的assets文件夹，拷贝到meetup/public目录。
在resources/views目录中新建一个叫做welcome文件夹。
把index.html和about.html拷贝到resources/views/welcome，并把文件后缀名都改为blade.php。
修改about和index页面导航栏中的链接地址。
<a href="/">Meetup</a>
<li><a href="/about">关于</a></li>
通过浏览器访问 /和 /about 现在都可以正常浏览页面了。

布局模板
写程序有一个原则，就是Don't Repeat Yourself，因为重复的代码，你改动一个地方，就要有两倍的工作量了。现在index之中有一大部分内容都是和about模板中一样的，这就造成两个模板中，存在大量重复的代码。

所以这是个问题，看看 laravel 怎么来解决。这就涉及到一个概念，叫做 layout 布局模板。

到resources/views之中新建一个layouts文件夹。
将about.blade.php复制到layouts，并改名为app.blade.php。
找到和index页面不同的中间部分。用@yield('content')代码替代。这样一个布局模板就已经定义完了。
再来到about.blade.php中，删除所有共同的部分，只保留不同的地方。加上这些代码包裹起来。
@extends('layouts.app')
@section('content')
    <div class="detail">
        <div class="am-g am-container">
            <div class="am-u-lg-12">
                <h1 class="detail-h1">About</h1>
            </div>
        </div>
    </div>
@endsection
到index.blade.php中，也按同样的方法处理。再来访问，发现依然是可以正常浏览的。

静态文件路径修改
最后再来做一点优化。到app布局模板中，给所有的assets路径前面加上一个/。
这是为了防止后面的课程，出现路径错误。对于初学者来说，暂时不需要太了解太多细节。

好，这一集就到这里。
# 笔记二
首页显示的两条最新活动，是我们html模板中写死的数据。他们与我们php程序一点关系都没有。
现在我们就想办法，让这两条数据从 controller中发出，然后在模板中显示。



controller里传数据
public function index()
{
    $issues = [
        ['title' => 'PHP lovers'],
        ['title' => 'Rails and Laravel']
    ];
    return view('welcome.index')->with('issues', $issues);
}
修改index.blade.php
删除一条重复的issue，然后给另一条做foreach循环

@foreach($issues as $issue)
    <li class="...">
        ...
        <a href="issues_show.html">{{$issue['title']}}</a>
        ...
    </li>
@endforeach
刷新页面，看到数据已经显示为我们控制器中的数据了

Sub-Views
https://laravel.com/docs/5.5/blade#including-sub-views

对于最新活动列表，我们还可以把他分离为一个 子视图文件。

步骤
在 resources/views/welcome 中添加活动列表 _issue_list.blade.php文件。
将index.blade.php中活动列表部分的代码，剪切到_issue_list.blade.php中。
再到 index.blade.php中加上
@include('welcome._issue_list')
重新访问，依然可以正常显示。

Tips: 我个人习惯将 子视图文件名，加上一个_前缀，这个习惯也是来自于ruby on rails了。好处是，可以直观的把子视图和其他模板区分开。
# 笔记三
前面把要展示的数据都放在了 controller 里。
那么设想一下，假如现在有另一个人发布了1个新活动，那我们是不是要去修改controller代码，加入1条新数据。
假如现在有人发布了100个活动，我们岂不是要去修改代码，加入100条数据？
这么做实在是太笨了，也完全不现实。



我们聪明的人类，当然不会干这么笨的事情了。那来欢迎今天的重量级嘉宾吧，mysql数据库。

初识数据库
不用说就该猜到了，数据库里面存的当然是数据了。这里对应我们项目的，就是各个活动信息。
最简单的一个例子，数据库就是类似于一个表格。

id	title
1	Laravel meetup
2	I love php and ruby
Tips:
1. 表中的id title ，这些我们叫做字段。
2. id就是一个编号，一般都会设置让他自己不断增加。
3. 下面存放的就是对应存放的真实数据了。

将来再有人发布新的活动，只需要在数据库中插入一新条记录，显示出来就好了。
相信我，这比直接修改控制器的代码，来的方便的多了。

修改数据库连接
这次相关的配置文件是根目录下的 .env文件， 里面写明了要使用的数据库和用到的账号密码 。

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meetup
DB_USERNAME=root
DB_PASSWORD=root
Tips: 使用laragon的同学注意，你的DB_PASSWORD留空就好。

修改完成后，记得按 ctrl+c 重启一下服务。

安装数据库操作软件
来安装一个小巧的数据库操作软件，叫 Sequel Pro 。
http://www.sequelpro.com/download 下载之后，拖到应用目录，双击就可以打开了。
登录需要填写 Host 为127.0.0.1（本机），mysql 的用户名 root，密码也是root。 Port 就不用填了。



Tips: 使用windows的同学，可以使用navicat（推荐）或者phpmyadmin来操作数据库。

新建数据库
连接上去以后，我们新建一个叫做meetup的数据库，选择utf8mb4编码



建立数据表结构
更改数据库的表结构，laravel 给出的方法是 migration
https://laravel.com/docs/5.5/migrations

php artisan make:migration create_issues_table --create=issues
生成的文件名的前面是时间戳，2017_11_29… 今天就是 2017年11月29号。里面可以添加需要的字段。

至于database/migrations文件夹中已经默认存在的create_users_table和create_password_resets_table是我们后面做用户登陆注册需要用到的，咱们暂时先不需要关注它。

public function up()
{
    Schema::create('issues', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->timestamps();
    });
}
运行

php artisan migrate
来把内容真正写进 mysql 数据库。

建立 model
model 文件要放在 app/Models 下面，名字叫 Issue.php

php artisan make:model Models/Issue
class Issue extends Model
{
}
这里的 class 命名是很关键的，如果数据库中的表名是issues，那这里的class名就必须是 Issue，也就是首字母大写，同时变成单数。为啥要这样？ 因为这样laravel就可以建立自动的 class 到 table 的映射关系了，以后要操作issues这张表，就无比的方便。

Tips：如果你需要将model和对应的migration一下全部建出来，下次也可以直接使用php artisan make:model Models/Issue -m 这一条命令。这样他会同时生成model和migration。

填充数据
这样就可以打开 laravel tinker 来真正对这样表进行操作了，具体可以参考 
https://laravel.com/docs/5.5/artisan#introduction

php artisan tinker
插入需要的记录

use App\Models\Issue

Issue::create(['title' => 'PHP Lover'])
Issue::create(['title' => 'Rails and Laravel'])
Issue::all()
屏幕提示一个错误信息
Illuminate\Database\Eloquent\MassAssignmentException with message 'title'

这个是 laravel 为了防止坏人恶意提交数据攻击网站，而采用的自我保护机制。你想啊，如果不加说明，坏蛋们就可以在表单中人为植入其他的参数。



所以必须要你自己指明哪些字段是允许直接用来赋值的。使用的方式就是 https://laravel.com/docs/5.5/eloquent#mass-assignment。

要做的修改非常简单，就是到 Issue模型中，添加白名单。

class Issue extends Model
{
    protected $fillable = ['title'];
}
按ctrl + c或者输入exit，退出tinker。
再重新进入tinker，这样再来提交，操作成功了。

修改controller和view
现在在 controller 中读取数据

use App\Models\Issue;

class WelcomeController extends Controller
{
    public function index()
    {
        $issues = Issue::orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        return view('welcome.index')->with('issues', $issues);
    }
}
Tips:
1. orderBy的意思是排序。created_at是添加数据的时候，laravel自动帮添加的当前时间。
2. desc是倒序（从大到小）。这样最新发布的issue会就在最上面了。
3. take(2)的意思，是说这里只读取两条数据。

再到 _issue_list.blade.php 中在稍作修改就好了。

{{$issue->title}}
# 笔记四

全13回  2018年04月26日 发布
The PHP Framework For Web Artisans，laravel 是适合艺术家来使用的 web 框架，一切东西都要尽可能的完美。
laravel 是目前世界上最流行的 php开发框架。

适合观众
学习本课程，你不一定要多会 php。有其他编程语言基础，特别是一些会面向对象编程的更好。也不需要你先掌握 css 和 js ，但是最少要懂一点 html。

课程非常适合 web 开发的初学者来学习，也适合已经会用 thinkphp 或其他 php 框架的同学学习。如果你之前是使用 python 、 ruby 或者 java 、 c# 来开发 web ，现在想学习 php开发，那本课程也是非常适合你的。

内容介绍
手把手教你用 laravel 打造一个 精美的web 应用程序。

课程中不用你制作乏味的静态页面，所有的页面模板我都已经准备好了，你只要改改就行。
也没有晦涩难懂的概念，上手就是干，自己动手一步步制作一个聚会的网站，可以发布聚会信息，参与者可以发表评论。

每一个知识点都是为了解决实际开发中碰到的一个个问题。坚决反对死学理论知识，不实际动手的学习方法。一切知识都应该在实践中学习掌握。

手把手带你做一个真实的项目，让你对 web 开发，对 laravel 框架的使用有一个最清晰的认识。只有自己动手做出项目来了，有了成就感，对开发有了兴趣，你才能真正的学会这一门艺术。

好的，让我们携手一起步入世界上最流行的 web 开发框架之一-laravel的世界。

项目Github地址
你可以从这里得到完整的项目源码。html模板，请依照视频课程切换到html分支中。
https://github.com/AaronRyuu/laravel_meetup

课程讨论QQ群
课程中有任何问题，你可以在讨论群中提出。但有提问，知无不言。
武汉PHP-前端学习交流 76093078（临时）

超简单的Laravel新手入门教程（全13回）
第1回
2017/10/25

【课程介绍】
第2回
2017/11/16

【开发环境Mac篇】
第3回
2017/11/16

【开发环境Windows篇】
第4回
2017/11/16

【The Laravel Way】
第5回
2017/11/16

【笨办法发消息】
第6回
2017/11/16

【数据的仓库】
第7回
2017/11/16

【瞄准一个东东来 CURD】
第8回
2017/11/16

【网站的耳朵】
第9回
2017/11/16

【天啊，一大堆issues（分页）】
第10回
2017/11/16

【更新一个资源】
第11回
2017/11/16

【Code Beauty（Resource Controllers）】
第12回
2017/11/16

【添加评论】
第13回
2017/11/16

【Until Next Time, Goodbye!】
现在有了 issue 也就是活动信息这个东东，后面就开始对他 Create Update Read Delete 了。

这一集只是开始，瞄准 issue的展示和删除 。 关于 CURD 比较详细的解释，参考 https://laravel.com/docs/5.5/eloquent#inserting-and-updating-models

issue的展示


添加 content 到 issue
首先运行一下 migration

php artisan make:migration add_content_to_issues_table --table=issues
修改migration文件

class AddContentToIssuesTable extends Migration
{
    public function up()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
}
别忘了php artisan migrate，来跑一下迁移命令。

Tips: down里面写的是 up的反操作。将来如果写错了，将来可以通过php artisan migrate:rollback这一条命令来回滚对数据库的操作。

插入一下数据
下面打开 php artisan tinker

use App\Models\Issue
$i = Issue::find(1)
$i->content = "The PHP Framework For Web Artisans"
$i->save()

$i = Issue::find(2)
$i->content = "Imagine what you could build if you learned Ruby on Rails ..."
$i->save()
添加路由
在web.php中加上

Route::get('issues/{issue}', 'IssuesController@show');
到 _issue_list.blade.php 中添加指向 IssuesController@show 页面的链接

<a href="/issues/{{$issue->id}}">{{$issue->title}}</a>
访问一下，屏幕提示IssuesController does not exist，相信你一看到这个提示，就应该知道下面我们应该做什么了。

新建控制器
php artisan make:controller IssuesController -r
控制器中会自动生成7个方法，分别用来处理 issues 的CURD操作了。
先得到 IssuesController 中

public function show($id)
{
    return $id;
}
这样敲链接 http://127.0.0.1:8000/issues/1 页面上就显示 1，敲 http://127.0.0.1:8000/issues/2 的时候页面就显示 2。
那这个 $id 的作用也就清楚了。当然这只是处于调试目的，所以这一行可以删掉。

重点注意：首先要来use这个模型

use App\Models\Issue;
public function show($id)
{
    $issue = Issue::find($id);
    return view('issues.show')->with('issue', $issue);
}
添加show页面
下面就是要填充 views/issues/show.blade.php 中的内容了。这样 show 页面中再添加合适的 php 语句就可以展示清楚了。

在resources/views中新建一个issues文件夹
将issues_show.html模板放入issues目录中，并改名为show.blade.php。
访问一下，确认能正常显示。修改图片的路径为<img src="/...。使用布局模板。
将以前写死的数据，换成我们从数据库中读取的内容。
<!-- 标题 -->
 <div class="issue-heading">
    ... 
    {{$issue->title}}
    ...
</div>

<!-- 内容 -->
<div class="am-comment-bd">{{$issue->content}}</div>
使用命名路由
但是再来稍微优化一些代码。到 _issue_list.blade.php，修改/issues/{{$issue->id}}为

{{route('issues.show', $issue->id)}}
这样当然会报错，这是laravel 提供了给路由起名字的机制，叫 named route，需要做的就是到 web.php 中

Route::get('issues/{issue}', 'IssuesController@show')->name('issues.show');
现在就行了。

删除一个资源
现在就来看如果删除一个资源。还是从 view 中的链接开始写。在 issues/show.blade.php 中添加删除的链接地址。

<a href="{{route('issues.destroy', $issue->id)}}" ...>Destroy</a>
对应的 web.php路由 中要添加

Route::delete('issues/{issue}', 'IssuesController@destroy')->name('issues.destroy');
点击删除后，发现依然跳转到了当前页面，这是因为我们路由中定义的是delete动作，而普通的链接依旧是get的请求方式。

我们需要使用一个js插件来解决这个问题。在提供的html模板中，已经给出了。你所要做的只是引用一下就好了。

到views/layouts/app.blade.php的</body>标签前加上

...
<script src="/assets/js/laravel.js"></script>
</body>
...
将删除链接修改为

<a href="{{route('issues.destroy', $issue->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?" ...>Destroy</a>
再到 IssuesController.php中 添加删除相关的代码

public function destroy($id)
{
    Issue::destroy($id);
    return redirect('/');
}
# 笔记五
当代的网站不仅能够向访问者展示信息，也能去倾听访问者的声音。这个主要是通过 form 实现的。



增加路由
首页的 发布新活动 的按钮，链接改为

<a href="{{route('issues.create')}}" ...>发布新活动</a>
web.php路由 中添加

Route::get('issues/create', 'IssuesController@create')->name('issues.create');
注意：这一行路由要写在 get 'issues/{issue}' 的上面。这是因为larave的路由是从上往下匹配的，我们要让它先找到新增，再去找显示。

controller中显示新增页面
IssuesController.php 中添加

public function create(){
    return view('issues.create');
}
增加create页面
然后创建 resources/views/issues/create.html.erb

复制提供的issues_create.html，并后缀为blade.php。
使用布局模板，相信大家都已经知道该怎么处理了。
修改form的action="{{route('issues.store')}}"
@extends('layouts.app')

@section('content')
    <div class="am-container">
        <div class="header">
            <div class="am-g">
                <h1>添加新活动</h1>
            </div>
            <hr>
        </div>

        <form class="am-form" action="{{route('issues.store')}}" method="post">
            <fieldset>
                <div class="am-form-group">
                    <label>标题</label>
                    <input type="text" placeholder="输入活动标题" name="title">
                </div>

                <div class="am-form-group">
                    <label>内容</label>
                    <textarea rows="5" name="content"></textarea>
                </div>

                <button type="submit" class="am-btn am-btn-default">提交</button>
            </fieldset>
        </form>
    </div>
@endsection
Tips:
1. 目前注意的是method 和 action，因为他俩决定了表单的提交方式和要提交到哪里去。
2. 另一个要注意的是表单中的name，他决定了laravel收到后，值对应的名字叫什么。

浏览一下发现报错， Route [issues.store] not defined. 所以就知道 web.php 中应该怎么写了。

添加路由

Route::post('issues', 'IssuesController@store')->name('issues.store');
接受数据
这样，就要在 IssuesController.php 中添加

public function store(Request $request)
{
    return $request->all();
}
点击提交后，又报错了。这又是laravel 为了防止 跨站请求伪造，而采用的自我保护机制了。

所以我们要让laravel知道，当前提交表单的页面，是来自于他自己的。使用的方式就是
https://laravel.com/docs/5.5/csrf

要做的修改非常简单，就是到 form标签 中添加

<form>
    {{csrf_field()}}
...
</form
再次提交，可以看到我们提交的数据。



Tips:
1. 这里显示的_token，就是刚才添加的csrf_field。只要有了这个值，laravel就会自动处理相关的安全问题。
2. 如果你想和我一样显示漂亮的数据格式，请给chrome浏览器安装JSON-handle或者jsonView等插件。

将数据添加到数据库中
public function store(Request $request)
{
    Issue::create($request->all());
    return redirect('/');
}
Issue.php模型中，加上content白名单

protected $fillable = ['title', 'content'];
这样再来提交，操作成功了。