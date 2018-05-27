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