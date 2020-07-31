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
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `fio`, `password`, `salt`) VALUES
(1, 'aa@aa.ru', 'user1', 'Иванов Иван Иванович', '3ae22609aa53d697fdfe789056215ee6', '5f2485e5b08c1'),
(2, 'aa@aa.ru', 'user2', 'Петров Петр Иванович', '3ae22609aa53d697fdfe789056215ee6', '5f2485e5b08c1'),
(3, 'cc@cc.ru', 'user3', 'Сидоров Михаил Иванович', '3ae22609aa53d697fdfe789056215ee6', '5f2485e5b08c1'),
(4, 'dd@dd.ru', 'user4', 'Ермаков Николай Иванович', '3ae22609aa53d697fdfe789056215ee6', '5f2485e5b08c1'),
(5, 'cc@cc.ru', 'user5', 'Ермаков Николай Иванович', '3ae22609aa53d697fdfe789056215ee6', '5f2485e5b08c1'),
(6, 'cc@cc.ru', 'user6', 'Ермаков Николай Иванович', '3ae22609aa53d697fdfe789056215ee6', '5f2485e5b08c1');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

