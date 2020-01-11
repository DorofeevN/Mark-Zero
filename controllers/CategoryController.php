<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.05.2016
 * Time: 10:00
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController{

    // public function actionIndex(){
    //     $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
    //     $this->setMeta('E-SHOPPER');
    //     return $this->render('index', compact('hits'));
    // }
    public function actionIndex(){
        //$hits = Product::find()->where(['hit' => '1'])->all();
        $queryhit = Product::find()->where(['hit' => '1']);
        $onsales = Product::find()->where(['sale' => '1'])->limit(3)->all();
        //$onsales = shuffle($onsales);
        //debug($onsale);
        //$hits = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $queryhit->count(), 'pageSize' => 6, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $hits = $queryhit->offset($pages->offset)->limit($pages->limit)->all();

        foreach ($queryhit->asArray()->all() as $hit) {
          $rangeprice[] = floatval($hit['price']);
        }

        $this->setMeta('Mk.0 | '."Главная страница.");
        return $this->render('index', compact('hits', 'pages', 'onsales', 'rangeprice', 'indcategories'));
    }

    public function actionView($id){
//        $id = Yii::$app->request->get('id')

        $category = Category::findOne($id);
        //debug($category);
        if(empty($category))
            throw new \yii\web\HttpException(404, 'Такой категории нет');

//        $products = Product::find()->where(['category_id' => $id])->all();
        if($category['parent_id']){
            $query = Product::find()->where(['category_id' => $id]);
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $products = $query->offset($pages->offset)->limit($pages->limit)->all();
            $this->setMeta('Mk.0 | ' . $category->name, $category->keywords, $category->description);
            return $this->render('view', compact('products', 'pages', 'category'));
        }
        else {
            $categoryquery = $secondcats = Category::find()->where(['parent_id' => $id])->andWhere(['>','id' , 0]);
            $pages = new Pagination(['totalCount' => $categoryquery->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $categories = $categoryquery->offset($pages->offset)->limit($pages->limit)->all();
            //$categories = array_slice($categories, 1, (array_key_last($categories)));
            $secondcats = $secondcats->all();


            if ($id) {
                $randimage = [];
                foreach ($secondcats as $secondcatkey => $secondcat) {
                    $randimage[$secondcat['name']] = [];
                    $products = Product::find()->where(['category_id' => $secondcat['id']])->limit(10)->all();
                    $rand_key = array_rand($products);
                    $randimage[$secondcat['name']] = $products[$rand_key]['img'];
                }
            }
            else{
                $randimage = [];
                foreach ($secondcats as $secondcatkey => $secondcat){
                    //$randimage[] = $secondcat['name'];
                    $manufacturers = Category::find()->where(['parent_id' => $secondcat['id']])->all();
                    if($manufacturers){
                        foreach ($manufacturers as $manufacturekey => $manufacture){
                            $products = Product::find()->where(['category_id' => $manufacture['id']])->limit(10)->all();
                            if(array_key_last($products)){
                                $rand_key = array_rand($products);
                                $randimage[$secondcat['name']] = $products[$rand_key]['img'];
                            }


                        }
                    }
                    else{
                        $randimage[$secondcat['name']] = $secondcat['name'];
                    }
                    //debug($manufacturers);


                }
            }

            //debug($randimage);
            //debug($subcatsq);
            return $this->render('view', compact('categories', 'pages', 'category', 'randimage'));
        }
    }

    public function actionSearch(){
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('Mk.0 | Поиск: ' . $q);
        if(!$q){
          return $this->render('search', compact('q'));
        }

        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }

    public function actionParent(){


        $querycat = Category::find()->where(['parent_id' => '0']);
      $pages = new Pagination(['totalCount' => $querycat->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
      $parentcategories = $querycat->offset($pages->offset)->limit($pages->limit)->all();
      $parentcats = Category::find()->where(['parent_id' => '0'])->limit(10)->all();


      $randimage = [];

        foreach ($parentcats as $parentkey => $parent) {
            $secondcats = Category::find()->where(['parent_id' => $parent['id']])->limit(10)->all();
            foreach ($secondcats as $secondcatkey => $secondcat){
                $products = Product::find()->where(['category_id' => $secondcat['id']])->limit(10)->all();
                $rand_key = array_rand($products);
                $randimage[$parent['name']] = $products[$rand_key]['img'];
            }
        }

      return $this->render('list', compact('parentcategories', 'pages', 'randimage'));
      //return $this->render('list', compact('parentcategories'));
    }



}
