---
extends: _layouts.post
section: content
title: "SDL: Как создать игру. События."
tags: [events, gamedev, sdl]
categories: [c/c++]
published: true
language: ru
post_date: 02.05.2012
---
<img class="oppic" src="/img/sdl_logo.png" alt="SDL" />Это вольный перевод и переосмысление статьи, <a href="http://www.sdltutorials.com/sdl-events">SDL Events</a> за авторством Tim Jones. Готовый код я буду выкладывать на [Github][2], откуда вы сможете скачать так же ZIP-архив. Если вы увидите ошибку, неточность, или у вас возникнут проблемы - обращайтесь: вы можете оставить комментарий или написать мне на почту, она указана внизу страницы.

Говоря об основах разработки игр нельзя не упомянуть о том, что называется событиями (Events). Все видеоигры, от Pong до очень сложных игр для ПК и консоли, используют события для взаимодействия с игроком. Эти события могут поступать от клавиатуры, мыши, джойстика, геймпада, и так далее, даже из операционной системы. Важно понять, как работают события, если мы хотим позволить пользователю взаимодействовать с игрой. Мы уже использовали события, но только для закрытия нашего окна, теперь мы посмотрим, как получать события от пользователя.

Если вы еще не догадались, каждая статья построена на основе предыдущих, так что будем использовать код из предыдущей статьи. Чтобы отслеживать все эти события и использовать их в наших функциях, давайте создадим новый класс. Создайте два файла с названиями: **Event.h** и **Event.cpp**. Эти два файла будет обрабатывать наши события, и вызвать соответствующую функцию. Класс App будет наследовать этот класс, поэтому, когда нам нужно будет поймать событие мы просто переопределим функцию.<!--more-->

Откройте **Event.h** и добавьте следующий код:
```cpp
#ifndef _EVENT_H_
#define _EVENT_H_

#include <SDL.h>

class Event {
    public:
        Event();
        virtual ~Event();
        virtual void Handle(SDL_Event* Event);
        virtual void OnInputFocus();
        virtual void OnInputBlur();
        virtual void OnKeyDown(SDLKey sym, SDLMod mod, Uint16 unicode);
        virtual void OnKeyUp(SDLKey sym, SDLMod mod, Uint16 unicode);
        virtual void OnMouseFocus();
        virtual void OnMouseBlur();
        virtual void OnMouseMove(int mX, int mY, int relX, int relY, bool Left,bool Right,bool Middle);
        virtual void OnMouseWheel(bool Up, bool Down);
        virtual void OnLButtonDown(int mX, int mY);
        virtual void OnLButtonUp(int mX, int mY);
        virtual void OnRButtonDown(int mX, int mY);
        virtual void OnRButtonUp(int mX, int mY);
        virtual void OnMButtonDown(int mX, int mY);
        virtual void OnMButtonUp(int mX, int mY);
        virtual void OnJoyAxis(Uint8 which, Uint8 axis, Sint16 value);
        virtual void OnJoyButtonDown(Uint8 which, Uint8 button);
        virtual void OnJoyButtonUp(Uint8 which, Uint8 button);
        virtual void OnJoyHat(Uint8 which, Uint8 hat, Uint8 value);
        virtual void OnJoyBall(Uint8 which, Uint8 ball, Sint16 xrel, Sint16 yrel);
        virtual void OnMinimize();
        virtual void OnRestore();
        virtual void OnResize(int w,int h);
        virtual void OnExpose();
        virtual void Exit();
        virtual void OnUser(Uint8 type, int code, void* data1, void* data2);
};

#endif
```

Немаленький класс, да? Так, а теперь откройте **Event.cpp** и добавьте следующий код:

```cpp
#include "Event.h"

Event::Event() {}
Event::~Event() {}

void Event::Handle(SDL_Event* Event) {
    switch(Event->type) {
        case SDL_ACTIVEEVENT: {
            switch(Event->active.state) {
                case SDL_APPMOUSEFOCUS: {
                    if ( Event->active.gain )
			OnMouseFocus();
                    else
			OnMouseBlur();
                    break;
                }
                case SDL_APPINPUTFOCUS: {
                    if ( Event->active.gain )
			OnInputFocus();
                    else
			OnInputBlur();
                    break;
                }
                case SDL_APPACTIVE:    {
                    if ( Event->active.gain )
			OnRestore();
                    else
			OnMinimize();
                    break;
                }
            }
            break;
        }

        case SDL_KEYDOWN: {
            OnKeyDown(Event->key.keysym.sym,Event->key.keysym.mod,Event->key.keysym.unicode);
            break;
        }

        case SDL_KEYUP: {
            OnKeyUp(Event->key.keysym.sym,Event->key.keysym.mod,Event->key.keysym.unicode);
            break;
        }

        case SDL_MOUSEMOTION: {
            OnMouseMove(Event->motion.x,Event->motion.y,Event->motion.xrel,Event->motion.yrel,(Event->motion.state&SDL_BUTTON(SDL_BUTTON_LEFT))!=0,(Event->motion.state&SDL_BUTTON(SDL_BUTTON_RIGHT))!=0,(Event->motion.state&SDL_BUTTON(SDL_BUTTON_MIDDLE))!=0);
            break;
        }

        case SDL_MOUSEBUTTONDOWN: {
            switch(Event->button.button) {
                case SDL_BUTTON_LEFT: {
                    OnLButtonDown(Event->button.x,Event->button.y);
                    break;
                }
                case SDL_BUTTON_RIGHT: {
                    OnRButtonDown(Event->button.x,Event->button.y);
                    break;
                }
                case SDL_BUTTON_MIDDLE: {
                    OnMButtonDown(Event->button.x,Event->button.y);
                    break;
                }
            }
            break;
        }

        case SDL_MOUSEBUTTONUP:    {
            switch(Event->button.button) {
                case SDL_BUTTON_LEFT: {
                    OnLButtonUp(Event->button.x,Event->button.y);
                    break;
                }
                case SDL_BUTTON_RIGHT: {
                    OnRButtonUp(Event->button.x,Event->button.y);
                    break;
                }
                case SDL_BUTTON_MIDDLE: {
                    OnMButtonUp(Event->button.x,Event->button.y);
                    break;
                }
            }
            break;
        }

        case SDL_JOYAXISMOTION: {
            OnJoyAxis(Event->jaxis.which,Event->jaxis.axis,Event->jaxis.value);
            break;
        }

        case SDL_JOYBALLMOTION: {
            OnJoyBall(Event->jball.which,Event->jball.ball,Event->jball.xrel,Event->jball.yrel);
            break;
        }

        case SDL_JOYHATMOTION: {
            OnJoyHat(Event->jhat.which,Event->jhat.hat,Event->jhat.value);
            break;
        }
        case SDL_JOYBUTTONDOWN: {
            OnJoyButtonDown(Event->jbutton.which,Event->jbutton.button);
            break;
        }

        case SDL_JOYBUTTONUP: {
            OnJoyButtonUp(Event->jbutton.which,Event->jbutton.button);
            break;
        }

        case SDL_QUIT: {
            Exit();
            break;
        }

        case SDL_SYSWMEVENT: {
            //Ignore
            break;
        }

        case SDL_VIDEORESIZE: {
            OnResize(Event->resize.w,Event->resize.h);
            break;
        }

        case SDL_VIDEOEXPOSE: {
            OnExpose();
            break;
        }

        default: {
            OnUser(Event->user.type,Event->user.code,Event->user.data1,Event->user.data2);
            break;
        }
    }
}

void Event::OnInputFocus() {}
void Event::OnInputBlur() {}
void Event::OnKeyDown(SDLKey sym, SDLMod mod, Uint16 unicode) {}
void Event::OnKeyUp(SDLKey sym, SDLMod mod, Uint16 unicode) {}
void Event::OnMouseFocus() {}
void Event::OnMouseBlur() {}
void Event::OnMouseMove(int mX, int mY, int relX, int relY, bool Left,bool Right,bool Middle) {}
void Event::OnMouseWheel(bool Up, bool Down) {}
void Event::OnLButtonDown(int mX, int mY) {}
void Event::OnLButtonUp(int mX, int mY) {}
void Event::OnRButtonDown(int mX, int mY) {}
void Event::OnRButtonUp(int mX, int mY) {}
void Event::OnMButtonDown(int mX, int mY) {}
void Event::OnMButtonUp(int mX, int mY) {}
void Event::OnJoyAxis(Uint8 which,Uint8 axis,Sint16 value) {}
void Event::OnJoyButtonDown(Uint8 which,Uint8 button) {}
void Event::OnJoyButtonUp(Uint8 which,Uint8 button) {}
void Event::OnJoyHat(Uint8 which,Uint8 hat,Uint8 value) {}
void Event::OnJoyBall(Uint8 which,Uint8 ball,Sint16 xrel,Sint16 yrel) {}
void Event::OnMinimize() {}
void Event::OnRestore() {}
void Event::OnResize(int w,int h) {}
void Event::OnExpose() {}
void Event::Exit() {}
void Event::OnUser(Uint8 type, int code, void* data1, void* data2) {}
```

Много кода, но нам надо покрыть все события SDL. В целом, мы просто берем указатель на SDL_Event, проверяем его тип и вызываем соответствующую функцию. Выглядит, что кода много, но это только потому, что много типов событий.

Теперь, когда с этим разобрались, перейдет к **App.h** и подключим наш новый класс:

```cpp
#ifndef _APP_H_
#define _APP_H_

#include <SDL.h>

#include "Event.h"
#include "Sprite.h"

class App : public Event {
    private:
        bool            Running;
        SDL_Surface*    Screen;
        SDL_Surface*    Test;

    public:
        App();
        int Execute();

        bool Init();
        void Event(SDL_Event* Evt);
        void Loop();
        void Render();
        void Cleanup();
};

#endif
```

Все должно хорошо скомпилироваться. Теперь надо связать поступающие события с нашим классом. Найдите App::Event() и измените функцию вот так:

```cpp
void App::Event(SDL_Event* Evt) {
    Event::Handle(Evt);
}
```

Мы передаем событие в наш класса, теперь он будет заботиться о правильном вызовов функций. Теперь, когда мы хотим использовать событие, мы должны переопределить функцию. Так как мы избавились от проверки события SDL_Quit, давайте использовать вместо этого метод класса. Откройте **App.h**, и добавьте следующие функции:

```cpp
#ifndef _APP_H_
#define _APP_H_

#include <SDL.h>

#include "Event.h"
#include "Sprite.h"

class App : public Event {
    private:
        bool            Running;
        SDL_Surface*    Screen;
        SDL_Surface*    Test;

    public:
        App();
        int Execute();

        bool Init();
        void Event(SDL_Event* Evt);
        void Loop();
        void Render();
        void Cleanup();
        void Exit();
};

#endif
```

Функция Exit() будет обрабатывать событие SDL_Quit. У нас есть прототип, позволяющий определить, что он делает, теперь добавим реализацию. Откройте **App.cpp** и добавьте следующее:

```cpp
void App::Exit() {
    Running = false;
}
```

Перекомпилируйте и попробуйте запустить. Программа должна закрываться по крестику как и раньше. Я рекомендую вам ознакомиться с несколькими другими событиями. В дальнейшем мы будем использовать некоторые из них в нашей игре.

Перейти на более чем на следующем уроке, чтобы взглянуть на создание нашей первой игре, крестики-нолики./strong

[2]: https://github.com/charnad/SDLTutorial
