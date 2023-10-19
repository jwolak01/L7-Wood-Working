<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // This function takes each Product within the DB, as well as the information relating
    // to the Product and stores each attribute of the Product in a specific array.
    // This is to assist when displaying the Product, its information, and it's images accordingly.
    public function index()
    {
        $products = Product::all()->sortByDesc('created_at');

        $productIDs = array();
        $productNames = array();
        $productDescriptions = array();
        $productInventory = array();

        foreach ($products as $product) {
            $productPaths = array();

            // Below adds the full path relating to the Product's cover image and stores into the current productPaths array
            $directory = public_path() . "/images/" . $product->directory . "coverImage";
            $images = File::allFiles($directory);
            $file = pathinfo($images[0]);
            $coverImage = $file['filename'];
            $imagePath = "/images/" . $product->directory . "coverImage/" . $coverImage . "." . $file['extension'];

            array_push($productPaths, $imagePath);

            // Below finds all other images relating to the Product, creates each  full path, and stores in current productPaths array
            $directory = public_path() . "/images/" . $product->directory;
            $images = File::allFiles($directory);

            foreach ($images as $image) {
                $file = pathinfo($image);

                if ($file['filename'] != $coverImage) {
                    $imagePath = "/images/" . $product->directory . $file['filename'] . "." . $file['extension'];
                    array_push($productPaths, $imagePath);
                }
            }

            array_push($productIDs, ($product->id)); // stores id in productIds array
            array_push($productNames, ($product->productName)); // stores Product name in productNames array
            array_push($productDescriptions, ($product->productDescription)); // stores Product description in productDescription arrays 
            array_push($productInventory, $productPaths); // stores productPaths array in productInventory array
        }

        // return array($productPaths);
        return view('products.gallery', [
            'productIDs' => $productIDs,
            'productNames' => $productNames,
            'productDescriptions' => $productDescriptions,
            'productInventory' => $productInventory,
        ]);
    }

    // ****************************************** //

    // ****************************************** //

    public function store(Request $request)
    {
        /* Examine existing product directories in public/images(id) path and add a new product directory */
        $productDirectoryID = 1;

        $imagesPath = public_path() . "/images/gallery/products(" . $productDirectoryID . ")/";

        while (File::isDirectory($imagesPath)) {
            $productDirectoryID++;

            $imagesPath = public_path() . "/images/gallery/products(" . $productDirectoryID . ")/";
        }

        File::makeDirectory($imagesPath, 0777, true, true);

        /* Create a "coverImage" folder within the newly created "products" path */
        $coverImagePath = $imagesPath . "coverImage/";

        File::makeDirectory($coverImagePath, 0777, true, true);

        /* Copy file in public/storage/images/coverImage path and place in newly created /coverImage path */
        $directory =  public_path() . "/storage/images/coverImage/";
        $coverImageFile = File::allFiles($directory);

        File::copy($directory . basename($coverImageFile[0]), $coverImagePath . basename($coverImageFile[0]));
        File::delete($coverImageFile);

        /* Copy all files in public/storage/images path and place in newly create /products(id) path*/
        $directory =  public_path() . "/storage/images/";
        $images = File::allFiles($directory);

        foreach ($images as $image) {
            File::copy($directory . basename($image), $imagesPath . basename($image));
            File::delete($image);
        }

        /* Delete all Image objects from Images Data Table */
        foreach (Image::all() as $imageObject) {
            $imageObject->delete();
        }
        /* Store "productName", "productDescription", "directory", and "coverImage" in the product table within the Database.*/
        $directory = 'gallery/products(' . $productDirectoryID . ')/';

        Product::create([
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'directory' => $directory,
            'coverImage' => basename($coverImageFile[0])
        ]);

        return redirect('/business');
    }

    // ****************************************** //

    public function show($id)
    {
        // The purpose of this function is to find the Product relating to the given id and display
        // that product and its images.
        $product = Product::findOrFail($id);

        $productPaths = array();

        // Locate coverImage, create a path relating to that coverImage, and place in array
        $directory =  public_path() . "/images/" . $product->directory . 'coverImage';
        $images = File::allFiles($directory);
        $file = pathinfo($images[0]);
        $coverImage = $file['filename'];

        $imagePath = "/images/" . $product->directory . "coverImage/" . $coverImage . "." . $file['extension'];
        array_push($productPaths, $imagePath);

        // Locate all other files and place in array
        $directory =  public_path() . "/images/" . $product->directory;
        $images = File::allFiles($directory);
        foreach ($images as $image) {
            $file = pathinfo($image);

            if ($file['filename'] != $coverImage) {
                $imagePath =  "/images/" . $product->directory . $file['filename'] . "." . $file['extension'];
                array_push($productPaths, $imagePath);
            }
        }

        // Return the product and the list of image paths
        return view('products.show', [
            'product' => $product,
            'productPaths' => $productPaths,
        ]);
    }

    // ****************************************** //

    public function edit($id)
    {

        $storedImagesDirectory =  public_path() . "/storage/images/";
        $images = File::allFiles($storedImagesDirectory);

        // If images are found in storage/images/coverImage/
        // Remove all images from directory and images table
        if (sizeof($images) > 0) {

            foreach ($images as $image) {
                // Delete Image object from the Images database
                $imageObject = Image::where('name', basename($image));
                $imageObject->delete();

                File::delete($image); //Delete image from public/storage/images path
            }
        }


        // This function locates the Product by the given id and provide the necessary information/images
        // in order to edit the current Product being examined
        $product = Product::findOrFail($id);

        $productPaths = array();
        $productImages = array();

        // Locate coverImage, create a path relating to that coverImage, and place in array
        $directory =  public_path() . "/images/" . $product->directory . 'coverImage';
        $images = File::allFiles($directory);
        $file = pathinfo($images[0]);
        $coverImage = $file['filename'];

        $productCoverImagePath = "/images/" . $product->directory . "coverImage/" . $coverImage . "." . $file['extension'];
        array_push($productImages, ($coverImage . "." . $file['extension']));

        // Locate all other files and place in array
        $directory =  public_path() . "/images/" . $product->directory;
        $images = File::allFiles($directory);
        foreach ($images as $image) {
            $file = pathinfo($image);

            if ($file['filename'] != $coverImage) {
                $imagePath =  "/images/" . $product->directory . $file['filename'] . "." . $file['extension'];
                array_push($productPaths, $imagePath);
                array_push($productImages, ($file['filename'] . "." . $file['extension']));
            }
        }

        return view('products.edit', [
            'product' => $product,
            'productCoverImagePath' => $productCoverImagePath,
            'productPaths' => $productPaths,
            'productImages' => $productImages
        ]);
    }

    // ****************************************** //
    // Once the user clicks to Confirm an edit all necessary information will be changed/added
    public function update(Request $request, $id)
    {
        //Find Product object by id
        $product = Product::findOrFail($id);


        //Update the product name and description in "products" table
        $product->productName = $request->input("productName");
        $product->productDescription = $request->input("productDescription");

        $product->update($request->all());

        /* Copy coverImage from public/storage/images/coverImage path and place in current directory being examined*/
        $storedImagesDirectory =  public_path() . "/storage/images/coverImage/";
        $images = File::allFiles($storedImagesDirectory);


        if (sizeof($images) > 0) {
            $productDirectory = public_path() . "/images/" . $product->directory . "coverImage/";
            $coverImage = File::allFiles($productDirectory);
            File::delete($coverImage);

            foreach ($images as $image) {
                File::copy($storedImagesDirectory . basename($image), $productDirectory . basename($image));
                File::delete($image); //Delete image from public/storage/images path
            }

            $product->coverImage = basename($images[0]);
        }


        /* Copy all files from public/storage/images path and place in current directory being examined*/
        $storedImagesDirectory =  public_path() . "/storage/images/";
        $images = File::allFiles($storedImagesDirectory);
        if (sizeof($images) > 0) {
            $productDirectory = public_path() . "/images/" . $product->directory;
            foreach ($images as $image) {
                File::copy($storedImagesDirectory . basename($image), $productDirectory . basename($image));
                File::delete($image); //Delete image from public/storage/images path
            }
        }


        /* Delete all Image objects from Images Data Table */
        foreach (Image::all() as $imageObject) {
            $imageObject->delete();
        }

        return redirect('/business')->with('status', "Product Updated Successfully");
    }

    // ****************************************** //

    public function create()
    {
        return view('products.create');
    }

    // ****************************************** //
    // Once an id is passed the function removes all files and the directory relating to the product's id
    // The function then removes that product from the Products table in the DB
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $directory =  public_path() . "/images/" . $product->directory;
        $imageFiles = File::allFiles($directory);

        foreach ($imageFiles as $image) {
            if (basename($image) == (request()->getContent())) {
                File::delete($image);
            }
        }

        File::deleteDirectory(public_path("/images/" . $product->directory));

        Product::where('id', $id)->delete();

        return redirect('/business');
    }

    // ****************************************** //

    // Removes all images from the given paths
    public function removeImage(Request $request)
    {
        $imgID = $request->input('id');
        $imgPaths = $request->input('image_path');

        foreach ($imgPaths as $imgPath) {
            File::delete(public_path($imgPath));
        }

        return redirect('/products/' . $imgID . '/edit');
    }
}
