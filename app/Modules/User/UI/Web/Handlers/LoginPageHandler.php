<?php


namespace psnXT\Modules\User\UI\Web\Handlers;


class LoginPageHandler
{
    public function __construct()
    {

    }

    public function __invoke()
    {
        return view('User.UI.Web.Views.login');
    }
}
