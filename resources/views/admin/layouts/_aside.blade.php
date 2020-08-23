<div class="app__aside is-opened" id="aside-slide">
  <div class="aside">
    <div class="aside__logo"><img src="{{ asset('images/admin/logo-text.png') }}" alt=""></div>
    <div class="aside__menu">
      <ul class="menu">
        <li class="menu__item"><a href="" class="menu__link {{!request()->is('/') ?: 'is-active'}}">Панель управления</a></li>
      </ul>
    </div>
  </div>
</div>
