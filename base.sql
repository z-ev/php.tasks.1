
--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `price`) VALUES
(1, 1, 100),
(2, 1, 200),
(3, 1, 50),
(4, 2, 50),
(5, 2, 200),
(6, 2, 50),
(7, 3, 10),
(8, 3, 20),
(9, 3, 30),
(10, 4, 1000),
(11, 4, 2000),
(12, 5, 300);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `login` varchar(55) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `fio`, `password`, `salt`) VALUES
(1, 'aa@aa.ru', 'user1', 'Иванов Иван Иванович', 'a96be294f0deed889bd311a8ef997396', '5f2548619eefb'),
(2, 'aa@aa.ru', 'user2', 'Семенов Семен Андреевич', '4821c4fdac1fb288cee70f6c72cbc912', '5f254873ee24b'),
(3, 'bb@bb.ru', 'user3', 'Петров Александр Николаевич', '20a1aa7dad8c66221b6dab35520aeabb', '5f2548905ae72'),
(4, 'cc@cc.ru', 'user4', 'Сидоров Петр Иванович', '2c302a1ac856e2a4ee76a61f7132bb40', '5f2548b17583f'),
(5, 'cc@cc.ru', 'user5', 'Киркоров Юрий Викторович', 'eb6cf04079d31fa9b32758f6070aa0af', '5f2548d9b1449'),
(36, 'ee@ee.ru', 'user6', 'Галанов Никита Васильевич', 'ad72d740f1c72f940ace40987ae8eea1', '5f25495500951'),
(37, 'hh@hh.ru', 'user7', 'Жданов Алексей Алексеевич', 'ab903f30387625f5ed8d6c61ee720540', '5f2549687a671'),
(38, 'hh@hh.ru', 'user8', 'Николаев Виктор Андреевич', '412fde3664ec8759ac648baa34404165', '5f2549899f718');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;
