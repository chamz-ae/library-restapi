CREATE TABLE category (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE author (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE publisher (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE book (
    id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE book_copy (
    id INT PRIMARY KEY,
    year_published INT,
    book_id INT,
    publisher_id INT,
    FOREIGN KEY (book_id) REFERENCES book(id),
    FOREIGN KEY (publisher_id) REFERENCES publisher(id)
);

CREATE TABLE patron_account (
    card_number CHAR(10) PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    status VARCHAR(10)
);

CREATE TABLE checkout (
    id INT PRIMARY KEY,
    start_time TIMESTAMP,
    end_time TIMESTAMP,
    book_copy_id INT,
    patron_account_id CHAR(10),
    is_returned BOOLEAN,
    FOREIGN KEY (book_copy_id) REFERENCES book_copy(id),
    FOREIGN KEY (patron_account_id) REFERENCES patron_account(card_number)
);

CREATE TABLE hold (
    id INT PRIMARY KEY,
    start_time TIMESTAMP,
    end_time TIMESTAMP,
    book_copy_id INT,
    patron_account_id CHAR(10),
    FOREIGN KEY (book_copy_id) REFERENCES book_copy(id),
    FOREIGN KEY (patron_account_id) REFERENCES patron_account(card_number)
);

CREATE TABLE notification (
    id INT PRIMARY KEY,
    sent_at TIMESTAMP,
    type VARCHAR(20),
    patron_account_id CHAR(10),
    FOREIGN KEY (patron_account_id) REFERENCES patron_account(card_number)
);

CREATE TABLE book_author (
    book_id INT,
    author_id INT,
    PRIMARY KEY (book_id, author_id),
    FOREIGN KEY (book_id) REFERENCES book(id),
    FOREIGN KEY (author_id) REFERENCES author(id)
);

CREATE TABLE waitlist (
    patron_id CHAR(10),
    book_id INT,
    PRIMARY KEY (patron_id, book_id),
    FOREIGN KEY (patron_id) REFERENCES patron_account(card_number),
    FOREIGN KEY (book_id) REFERENCES book(id)
);
