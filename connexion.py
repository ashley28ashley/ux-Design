from faker import Faker
import pymysql  # Remplacez par pymysql pour MySQL

fake = Faker()
connection = pymyql.connect(
    dbname="your_db", user="your_user", password="your_password", host="localhost"
)
cursor = connection.cursor()

for _ in range(1000):
    name = fake.word().capitalize()
    description = fake.sentence()
    price = round(fake.random_number(digits=2), 2)
    image_url = fake.image_url()
    cursor.execute(
        "INSERT INTO products (name, description, price, image_url) VALUES (%s, %s, %s, %s)",
        (name, description, price, image_url),
    )

connection.commit()
cursor.close()
connection.close()
