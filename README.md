# Proyecto Inicial

## Idea a Implementar

El proyecto se trata de una tienda virtual orientada a ropa y calzado deportivo en el que el cliente puede recorrer la tienda viendo los productos disponibles añadirlos a su carrito de compras, el cuál puede modificar y eventualmente confirmar, haciendo efectiva su compra.

## Diagrama ER

![Diagrama entidad-relación](public\assets\VirtualStoreERDiagramV1.0.jpg)

Como característica a notar en el diagrama, se puede ver que el carrito de compras registra un valor 'total_price' que representa el precio total del carrito al momento de confirmarlo. Cuando se guarda en la base de datos, esta entidad será inmutable.

Esto se decidió de esta manera, en oposición a la idea de dejar el precio total del carrito de manera computable dinámicamente a partir de los productos a los que está asociado, ya que si a un producto se le actualiza el precio, se verá afectado retroactivamente el precio de un carrito ya confirmado en el pasado, y no se quiere eso.

## Actualizaciones e información de los datos

Desde la vista de administrador, se permitirá que este pueda crear, modificar y eliminar cada registro para las entidades de categorías, marcas, productos, detalles de orden y carritos de compra.
Los reportes que se podrán visualizar en la aplicación Laravel serán respectivos para cada tipo de usuario (El administrador tendrá su propia vista en la que puede hacer alta, baja y modificación de cada entidad y también verá las que están presentes en la base de datos).
A través de la API de la aplicación Laravel se podrá obtener información de cada producto, categoría, marca, detalle de orden y carrito de compra.
A través de la API de la aplicación Laravel se podrá crear el registro de un carrito de compra y sus detalles de orden asociados (ya que los usuarios finales harán compras y se deberá persistir esta información en la base de datos).

## Visualización y Acceso a la Información

El usuario final (que en principio no tendrá login, pero se identificará con su email) podrá visualizar la totalidad de productos de la tienda y se podrá hacer búsquedas específicas utilizando filtros, por ejemplo, por marca, categoría, nombre, precio, etc.

Entre las acciones posibles, se incluye la posibilidad de realizar compras de productos, utilizando un carrito de compras que se puede modificar de manera libre, agregando y  eliminando del carrito los productos deseados previamente a la confirmación de su compra.

En su primera sesión, se solicitará su email para su vinculación a sus carritos al momento de confirmar una compra con un carrito y en futuras sesiones se usará para ver los datos de sus propios carritos de compra hechos, como la fecha de su compra, cantidad de productos asociados y precio total del pedido.

<br>
<br>
<br>

# Initial Project

## Idea to Implement

The project is about a virtual store focused on sportswear and footwear, in which the customer can browse the store, view the available products, add them to their shopping cart, which they can modify and eventually confirm, making their purchase effective.

## ER Diagram

![Diagrama entidad-relación](public\assets\VirtualStoreERDiagramV1.0.jpg)

As a noteworthy feature in the diagram, it can be seen that the shopping cart records a 'total_price' value which represents the total price of the cart at the moment of confirmation. When saved in the database, this entity will be immutable.

This decision was made in contrast to the idea of leaving the total price of the cart computable dynamically based on the products it is associated with, as if a product's price is updated, it will retroactively affect the price of a cart already confirmed in the past, and that is not desired.

## Data Updates and Information

From the administrator's view, it will be allowed to create, modify, and delete each record for the entities of categories, brands, products, orders details, and shopping carts. The reports that can be viewed in the Laravel application will be respective for each type of user (The administrator will have their own view where they can create, delete, and modify each entity and also see the ones present in the database).

Through the Laravel application API, information can be obtained for each product, category, brand, order detail, and shopping cart. Through the Laravel application API, it will be possible to create a record for a shopping cart and its associated order details (since end-users will make purchases and this information needs to be persisted in the database).

## Information Visualization and Access

The end-user (who initially won't have a login but will identify themselves with their email) will be able to view all the products in the store, and specific searches can be made using filters, for example, by brand, category, name, price, etc.

Among the possible actions, the possibility of making purchases of products is included, using a shopping cart that can be freely modified by adding and removing desired products before confirming the purchase.

In their first session, their email will be requested for linking to their carts at the time of confirming a purchase with a cart, and in future sessions, it will be used to view the data of their own made shopping carts, such as the date of their purchase, the quantity of associated products, and the total price of the order.