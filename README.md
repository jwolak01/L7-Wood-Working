## About L7 woodworking

L7 woodworking is a local business that wishes to have a website in which the owner can upload his products and provide a description of each product on his website. Once a product is submitted images will be stored in an appropriate directory while the product’s information will be saved within a database. The business owner should also be able to utilize both the images and stored information in order to remove or edit a specified product.

Users/Customers of the website should be able to view the business’s product in a Gallery.
Furthermore, future aspirations include providing a Custom page in which users may contact the business owner on a piece of furniture they wish to have made for them.

## Setting up on Local Machine

- Obtain the appropriate folders (bin and laravel) from the Admin and paste into vendor folder
- Within Ubuntu (WSL) terminal insert the following commands:

```
  ./vendor/bin/sail up -d
  ./vendor/bin/sail root-shell
  php artisan storage:link
```
The last command is to assist in uploading and displaying images. If you still cannot view images after uploading locate the storage file found in the public folder and remove it. Then apply the previously mentioned commands again.

Close that terminal

Now, open another WSL terminal and add the following command:  

```
./vendor/bin/sail up
```

In a separate terminal, such as bash, use the command:

```
npm run dev
```

- To view the website go to the browser of your choosing and type "localhost"
- To view Dockerized Database in another tab type "localhost:8001" 


Now that you're officially setup just type "npm run dev" in bash terminal and "./vendor/bin/sail up" in WSL terminal whenever you would like to run the Laravel Sail Container
## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
