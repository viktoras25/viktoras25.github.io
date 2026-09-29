---
extends: _layouts.post
section: content
title: "SDL: Как создать игру. Координаты и блиттинг."
tags: [blitting, gamedev, sdl]
categories: [c/c++]
published: true
language: ru
post_date: 01.05.2012
---
<img class="oppic" src="/img/sdl_logo.png" alt="SDL" />Это вольный перевод и переосмысление статьи, [SDL Coordinates and Bliting](http://www.sdltutorials.com/sdl-coordinates-and-blitting) за авторством Tim Jones. Готовый код я буду выкладывать на [Github][2], откуда вы сможете скачать так же ZIP-архив. Если вы увидите ошибку, неточность, или у вас возникнут проблемы - обращайтесь: вы можете оставить комментарий или написать мне на почту, она указана внизу страницы.

Используя [первую статью](/read/sdl-tutorial-1-basics/), как базу, углубимся в мир поверхностей SDL. Я пытался донести до вас мысль, что SDL поверхности - это в основном изображения, хранящиеся в памяти. Представьте что, у нас есть пустая поверхность размером 320x240 пикселей. Если добавить к ней систему SDL координат, то получится что-то вроде этого:

<img src="/img/posts/2012-05-01-sdl-tutorial-2/coords.jpg">

Эта система координат отличается, от обычной. Обратите внимание, что координата Y увеличивается вниз, а координата X увеличивается вправо. Это важно понимать, чтобы правильно рисовать изображения на экране.<!--more-->

Поскольку у нас уже есть основная поверхность (Screen), нам нужен способ, чтобы рисовать на ней. Этот процесс называется блиттинг [*Blitting - Перенос битовых блоков*], когда мы в общем переносим одно изображение на другое. Но прежде чем мы сможем это сделать, мы должны загрузить эти изображения в память. SDL предлагает простую функцию для этого - SDL_LoadBMP. Примерный код может выглядеть следующим образом:
```cpp
SDL_Surface* TmpSurface;

if((TmpSurface = SDL_LoadBMP("mypicture.bmp")) == NULL) {
    //Error!
}
```

Все довольно просто, SDL_LoadBMP принимает один аргумент, имя файла, который вы хотите загрузить, и возвращает поверхность.  Если функция возвращает NULL, то либо файл не найден, либо поврежден или произошла какая-либо другая ошибка. К сожалению, чтобы все работало быстро, одного этого метода недостаточно. Часто изображение будет загружено в другом формате. И, когда мы будем отображать изображение на экране, мы можем столкнуться с потерей производительности, выпадением цветов изображения, и т.п. Но, к счастью SDL предлагает решение этой проблемы - функцию SDL_DisplayFormat. Она принимает уже загруженную поверхность, и возвращает новую, уже использующую тот же формат, что и дисплей. 

Давайте этот процесс завернем класс. Возьмем код из предыдущей статьи за основу и добавим два новых файла: **Sprite.h** и **Sprite.cpp**. Откройте **Sprite.h** и добавьте следующее:
```cpp
#ifndef _SPRITE_H_
#define _SPRITE_H_

#include <SDL.h>

class Sprite {
    public:
        Sprite();
    public:
        static SDL_Surface* Load(const char* File);
};

#endif
```

Мы создали простую статическую функцию Load, которая будет загружать файл в поверхность. Теперь откроем **Sprite.cpp**: 
```cpp
#include "Sprite.h"

Sprite::Sprite() {}

SDL_Surface* Sprite::Load(const char* File) {
    SDL_Surface* Temp = NULL;
    SDL_Surface* Result = NULL;

    if((Temp = SDL_LoadBMP(File)) == NULL) {
        return NULL;
    }

    Result = SDL_DisplayFormat(Temp);
    SDL_FreeSurface(Temp);

    return Result;
}
```

Надо отменить несколько важных вещей. Во-первых, всегда помните, что когда вы создаете указатель, установите его в значение NULL или 0.  Вы можете столкнуться с проблемами, если вы это не сделаете. Во-вторых, обратите внимание, что SDL_DisplayFormat возвращает новую поверхность, а не перезаписывает оригинальную. Это важно помнить, потому что, поскольку он создает новую поверхность, мы должны освободить старую. В противном случае, у она так и будет занимать память.

Теперь у нас есть способ загрузки поверхностей в памяти, теперь же нужен способ отображать их поверх других поверхностей. Как и в случае с загрузкой изображений, SDL предлагает функцию для блиттинга: SDL_BlitSurface. Она не такая простая как SDL_LoadBMP, но все же достаточно простая. Откроем **Sprite.h** и добавим следующие прототипы функций:

```cpp
#ifndef _SPRITE_H_
#define _SPRITE_H_

#include <SDL.h>

class Sprite {
    public:
        Sprite();

        static SDL_Surface* Load(const char* File);
        static bool Draw(SDL_Surface* Dest, SDL_Surface* Src, int X, int Y);
};

#endif
```

Теперь откройте **Sprite.cpp**, и добавьте следующее: 
```cpp
#include "Sprite.h"

Sprite::Sprite() {
}

SDL_Surface* Sprite::Load(const char* File) {
    SDL_Surface* Temp = NULL;
    SDL_Surface* Result = NULL;

    if((Temp = SDL_LoadBMP(File)) == NULL) {
        return NULL;
    }

    Result = SDL_DisplayFormat(Temp);
    SDL_FreeSurface(Temp);

    return Result;
}

bool Sprite::Draw(SDL_Surface* Dest, SDL_Surface* Src, int X, int Y) {
    if(Dest == NULL || Src == NULL) {
        return false;
    }

    SDL_Rect Area;
    Area.x = X;
    Area.y = Y;

    SDL_BlitSurface(Src, NULL, Dest, &Area);

    return true;
}
```

Прежде всего, посмотрим на аргументы, которые передаются функции Draw. У нас есть две поверхности, и две переменные типа int. Первая поверхность Dest - на ней мы будем рисовавать, вторая поверхность Src - из нее будут браться данные для отображения. Можно сказать, что мы "наклеиваем" (помните аналогию со стикерами?) Src на Dest. X, Y - это координаты на поверхности Dest где будет находиться верхний левый угол изображения из Src. 

Теперь к содержимому функции. Сначала мы проверяем, что у нас есть действительная поверхность, иначе возвращаем false. Далее, определяем SDL_Rect. Это SDL структура, которая состоит из четырех элементов: X, Y, W, H.  Как вы, возможно, догадались, это задает размеры прямоугольника. В нашем случае, мы заботимся только о том, где мы рисуем, а не сколько. Поэтому, мы назначаем X, Y координаты на поверхности Dest. Если вам интересно, что означает NULL среди параметров функции SDL_BlitSurface, то это еще один параметр SDL_Rect. К нему мы вернемся позже. Наконец, мы вызваем функцию переноса изображения, и возвращаем true. 

Теперь, чтобы убедиться, что все это работает, давайте создадим тестовую поверхность. Откройте **App.h**, и создайте новую поверхность, и подключите недавно созданный **Sprite.h**:
```cpp
#ifndef _APP_H_
#define _APP_H_

#include <SDL.h>
#include "Sprite.h"

class App {
    private:
        bool            Running;
        SDL_Surface*    Screen;
        SDL_Surface*    Test;

    public:
        App();
        int Execute();

    public:
        bool Init();
        void Event(SDL_Event* Event);
        void Loop();
        void Render();
        void Cleanup();
};

#endif
```

Не забудьте инициализировать поверхность значением NULL в конструкторе: 

```cpp
App::App() {
    Test = NULL;
    Screen = NULL;
    Running = true;
}
```

И так же не забудьте "прибраться" за собой: 
```cpp
void App::Cleanup() {
    SDL_FreeSurface(Test);
    SDL_FreeSurface(Screen);
    SDL_Quit();
}
```

Давайте теперь загрузим изображение. Перейдите к функции App::Init(), добавьте код: 

```cpp

bool App::Init() {
    if(SDL_Init(SDL_INIT_EVERYTHING) < 0) {
        return false;
    }

    if((Screen = SDL_SetVideoMode(640, 480, 32, SDL_HWSURFACE | SDL_DOUBLEBUF)) == NULL) {
        return false;
    }

    if((Test = Sprite::Load("image.bmp")) == NULL) {
        return false;
    }

    return true;
}
```

Не забудьте заменить "image.bmp" реальным изображением, которое у вас есть. Если нету - откройте MSPaint, что-нибудь нарисуйте, и сохраните в той же папке, где будет ваш исполняемый файл. Теперь у нас есть загруженное изображение, которое можно нарисовать. Найдите App::Render и добавьте следующее:

```cpp
void App::Render() {
    Sprite::Draw(Screen, Test, 0, 0);

    SDL_Flip(Screen);
}
```

Обратите внимание на новую функцию SDL_Flip. Это просто обновление буфера и вывод Screen на экран. Это называется двойной буферизацией. Это процесс рисования всего в памяти, и, потом вывод на экран. Если этого не делать, получилось бы мерцающее изображение. Помните флаг SDL_DOUBLEBUF? Это он и включает двойную буферизацию. 

Скомпилируйте код и убедитесь, что все работает правильно. Вы должны увидеть изображение в верхнем левом углу экрана.  Если да, то поздравляю, вы на один шаг ближе к самой игре. Если нет, убедитесь, что ваш image.bmp находится в той же папке, что и исполняемый файл. Кроме того, убедитесь, что это действительно bitmap файл.

<img src="/img/posts/2012-05-01-sdl-tutorial-2/ss1.jpg">

Теперь давайте продвинемся немного дальше. Хотя это круто уметь рисовать изображение на экране, часто нам нужна только его часть. Возьмем, к примеру, набор тайлов (tileset):

<img src="/img/posts/2012-05-01-sdl-tutorial-2/tileset.png">

Хотя это одно изображение, мы хотим нарисовать отдельную его часть. Открытие еще раз **Sprite.h** и добавьте следующий код:
```cpp
#ifndef _SPRITE_H_
#define _SPRITE_H_

#include <SDL.h>

class Sprite {
    public:
        Sprite();

        static SDL_Surface* Load(const char* File);
        static bool Draw(SDL_Surface* Dest, SDL_Surface* Src, int X, int Y);
        static bool Draw(SDL_Surface* Dest, SDL_Surface* Src, int X, int Y, int X2, int Y2, int W, int H);
};

#endif
```

Теперь в **Sprite.cpp**<span style="color: red;"> (Внимание, мы добавляем еще одну функцию Draw, мы не заменяем первую)</span>:

```cpp
bool Sprite::Draw(SDL_Surface* Dest, SDL_Surface* Src, int X, int Y, int X2, int Y2, int W, int H) {
    if(Dest == NULL || Src == NULL) {
        return false;
    }

    SDL_Rect DestArea;

    DestArea.x = X;
    DestArea.y = Y;

    SDL_Rect SrcArea;

    SrcArea.x = X2;
    SrcArea.y = Y2;
    SrcArea.w = W;
    SrcArea.h = H;

    SDL_BlitSurface(Src, &SrcArea, Dest, &DestArea);

    return true;
}
```

Обратите внимание, что это в основном точно такая же функция, как и первыая, за исключением того, мы добавили еще один SDL_Rect. Этот SDL_Rect прямоугольник определяет, какие пикселы из исходного изображения скопировать в итоговое. Если, например, указаны параметры 0, 0, 50, 50, то отрисовано было бы лишь левая верхняя часть поверхности (квадрат размером 50х50).

<img src="/img/posts/2012-05-01-sdl-tutorial-2/draw2.jpg">

Давайте проверим как это работает, найдите App::Render(), и добавьте следующее: 

```cpp
void App::Render() {
    Sprite::Draw(Screen, Test, 0, 0);
    Sprite::Draw(Screen, Test, 70, 110, 90, 90, 50, 50);

    SDL_Flip(Screen);
}
```

<img src="/img/posts/2012-05-01-sdl-tutorial-2/ss2.jpg" alt="coordinates">

Должно получиться, что ваше изображение отображается по координатам 70, 110 и видна только его часть. Надо обратить особое внимание на то, как эти функции работают, и как устроена система SDL координат, мы будем еще не раз это использовать. 

[2]:https://github.com/charnad/SDLTutorial
