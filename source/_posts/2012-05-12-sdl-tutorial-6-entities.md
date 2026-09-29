---
extends: _layouts.post
section: content
title: "SDL: Как создать игру. Сущности."
tags: [entities, gamedev, sdl]
categories: [c/c++]
published: true
language: ru
post_date: 12.05.2012
---
<img class="oppic" src="/img/sdl_logo.png" alt="SDL" />Это вольный перевод и переосмысление статьи, [SDL Tutorial - Animation][1] за авторством Tim Jones. Готовый код я буду выкладывать на [Github][2], откуда вы сможете скачать так же ZIP-архив. Если вы увидите ошибку, неточность, или у вас возникнут проблемы - обращайтесь: вы можете оставить комментарий или написать мне на почту, она указана внизу страницы.

В этой статьей мы направим наши силы на создание сущностей (Entities). Сущности - это все, с чем можно взаимодействовать. Например, это может быть монстр или сундук с сокровищами, который можно открыть. В этом смысле, практически все в игре, что движется, это сущность. Камень, который является частью карты, который никогда не двигается, не является сущностью. Но если вы хотите, чтобы камень двигался, не важно по какой причине, то мы сделаем его сущностью.<!--more-->

Давайте начнем с создания двух новых файлов: **Entity.cpp** и **Entity.h**. Откройте заголовочный файл и добавьте следующее:

```cpp
#include <vector>

#include "Animation.h"
#include "Sprite.h"

class Entity {
    public:
        static std::vector<Entity*>    EntityList;

    protected:
        Animation      Anim;
        SDL_Surface*    Surface;

    public:
        float           X;
        float           Y;

        int             Width;
        int             Height;

        int             AnimState;

    public:
        Entity();
        virtual ~Entity();

        virtual bool Load(char* File, int Width, int Height, int MaxFrames);
        virtual void Loop();
        virtual void Render(SDL_Surface* Screen);
        virtual void Cleanup();
};
```

Теперь откройте Entity.cpp и добавьте это:

```cpp
#include "Entity.h"

std::vector<Entity*> Entity::EntityList;

Entity::Entity() {
    Surface = NULL;

    X = Y = 0.0f;

    Width = Height = 0;

    AnimState = 0;
}

Entity::~Entity() {}

bool Entity::Load(char* File, int Width, int Height, int MaxFrames) {
    if((Surface = Sprite::Load(File)) == NULL) {
        return false;
    }

    Sprite::Transparent(Surface, 255, 0, 255);

    this->Width = Width;
    this->Height = Height;

    Anim.MaxFrames = MaxFrames;

    return true;
}

void Entity::Loop() {
    Anim.Animate();
}

void Entity::Render(SDL_Surface* Screen) {
    if(Surface == NULL || Screen == NULL) return;

    Sprite::Draw(Screen, Surface, X, Y, AnimState * Width, Anim.GetCurrentFrame() * Height, Width, Height);
}

void Entity::Cleanup() {
    if(Surface) {
        SDL_FreeSurface(Surface);
    }

    Surface = NULL;
}
```

Теперь поясню. В этом классе мы инкапсулируем 5 основных компонентов, о которых я упоминал в первой статье. Это позволит нам работать с сущностями в игре гораздо проще, чем смешивать их в кучу со всем остальным в классе App. Первое, что вы можете заметить, это статический вектор, который называется EntityList. Этот вектор будет содержать все наши сущности, они будут легко доступны через Entity::EntityList, потому что он объявлен статическим. Надо особо отметить: мы объявляем EntityList в Entity, поскольку это предотвратит циклические зависимости в будущем. То есть, например мы попытаемся получить карту, чтобы обработать сущности на ней, а также хотим получить сущности, чтобы обработать карту. Map объявляет Entity, Entity объявляет Map, это повлечет за собой проблемы во время компиляции.

Так что этот вектор содержит все наши сущности в игре. Обратите внимание, что каждый член вектора - указатель. Это потому, что в дальнейшем мы будем наследовать все последующие классы сущностей от класса Entity. Так, например, если мы собираемся сделать игру Megaman, мы бы создали класс Megaman и унаследовали бы его от класс Entity. И, благодаря полиморфизму, мы можем хранить объекты класса Megaman в EntityList. Собственно поэтому, мы заявили функции в классе, как virtual, а некоторые члены как protected. 

Далее, у нас есть базовая информация о сущности, общая для всех: координаты, размеры, поверхность для ее(сущности) изображения. Также, у нас есть функция загрузки, она получает имя файла и загружает изображение из него. По умолчанию, устанавливается прозрачный цвет. Я хочу чтобы вы понимали, что все, что я делаю не высечено в камне. Вы можете, и я даже советую вам менять код по своему вкусу. Вы можете передавать функции Load больше или меньше параметров, может вы не хотите устанавливать прозрачность по умолчанию, кто знает. Пробуйте и не волнуйтесь, если где-то запутаетесь или ошибетесь, вы всегда сможете достать мой код.

Итак, у нас есть основная функция Loop, которая обрабатывает основные расчеты. Сейчас мы только занимаемся анимацией. Мы лишь меняем  MaxFrames, а остальное оставляем по умолчанию. Далее, функция Render, в качестве параметра передается поверхность для отображения. Чтобы можно было рисовать не только сразу на экран, но и на любую другую поверхность по вашему выбору. Ну и наконец, функция Cleanup, которая освобождает память и все такое. 

Как я уже говорил в начале, это лишь базовая структура класса Entity, она еще может не так много, но не волнуйтесь, в будущем сможет сделать все, что вы захотите. Итак, давайте заставим сущности работать. Откройте **App.h** и добавьте файл заголовка в начале, и объявить две сущности:

```cpp
#include "Entity.h"

//...

private:
    Entity         Entity1;
    Entity         Entity2;
```


Давайте теперь загрузим в них изображения, в App::Init.cpp добавьте следующее:

```cpp
if(Entity1.Load("./gfx/yoshi.bmp", 64, 64, 8) == false) {
    return false;
}

if(Entity2.Load("./gfx/yoshi.bmp", 64, 64, 8) == false) {
    return false;
}

Entity2.X = 100;

Entity::EntityList.push_back(&Entity1);
Entity::EntityList.push_back(&Entity2);
```

Я еще раз использую изображение Йоши и прошлой статьи.

Вспомните, что я говорил, про инкапсуляцию основных функции игры в классе Entity. Мы должны вызывать эти функции в соответствующих функциях App. Поэтому, откройте App::Loop и добавьте следующее: 

```cpp
for(int i = 0;i < Entity::EntityList.size();i++) {
    if(!Entity::EntityList[i]) continue;

    Entity::EntityList[i]->Loop();
}
```

Мы в обходим каждый элемент вектора и вызываем функцию Loop. Довольно просто. (И мы проверяем на NULL, чтобы не было ошибок). Теперь, давайте сделаем то же самое в App::Render:

```cpp
for(int i = 0;i < Entity::EntityList.size();i++) {
    if(!Entity::EntityList[i]) continue;

    Entity::EntityList[i]->Render(Screen);
}
```

и еще раз то же самое в App::Cleanup:

```cpp
for(int i = 0;i < Entity::EntityList.size();i++) {
    if(!Entity::EntityList[i]) continue;

    Entity::EntityList[i]->Cleanup();
}

Entity::EntityList.clear();
```

Обратите внимание, я добавил вызов функции очистки вектора.

Отлично, теперь скомпилируйте то, что получилось. Вы должны увидеть две фигурки Йоши на экране. В следующей статье мы рассмотрим создание карты.

[1]: http://www.sdltutorials.com/sdl-animation
[2]: https://github.com/charnad/SDLTutorial
