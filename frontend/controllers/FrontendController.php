<?php
namespace frontend\controllers;

use backend\models\Category;
use backend\models\NewsCategory;
use Yii;
use yii\web\Controller;


class FrontendController extends Controller
{
    public $mainMenu = array();
    public $uploadFolder;

    public function init()
    {
        parent::init();

    }

    public function beforeAction($action)
    {
        $this->createMenu();
        return parent::beforeAction($action);
    }

    public function getMegaContent($column_count)
    {

        $categories = Category::find()->all();

        $total = count($categories);

        $total_one_column = floor($total / $column_count);

        $result = array();

        /* @var $category \backend\models\Category */

        foreach ($categories as $category) {
            $children = array();

            foreach ($category->products as $product) {
                $children[] = array(
                    'label' => $product->name,
                    'url' => Yii::$app->urlManager->createUrl(['/course/view', 'id' => $product->id]),
                );
            }
            $result[] = array(
                'label' => $category->name,
                'url' => Yii::$app->urlManager->createUrl(['/course/list', 'category_id' => $category->id]),
                'children' => $children
            );

        }

        $new = array_chunk($result, $total_one_column);

        $result = array();

        foreach ($new as $key => $value) {
            if ($key < $column_count) {
                $result[$key] = $value;
            } else {
                $result[$key % $column_count] = array_merge($result[$key % $column_count], $value);
            }
        }

        return $result;
    }

    public function getTreeContent($objects)
    {

        $controller = $this->getUniqueId();
        $action = $this->action->id;

        $result = array();
        foreach ($objects as $item) {
            $result[] = array(
                'label' => $item->name,
                //'active' => $controller == 'news',
                'url' => Yii::$app->urlManager->createUrl(['/news/list', 'category_id' => $item->id]),
            );
        }

        return $result;
    }

    protected function createMenu()
    {

        $controller = $this->getUniqueId();
        $action = $this->action->id;

        $this->mainMenu = array(

            array(
                'type' => 'single',
                'active' => $controller == 'site' && $action == 'index',
                'name' => Yii::t('common', 'menu.home'),
                'url' => Yii::$app->urlManager->createUrl(['/site/index']),
            ),

            array(
                'type' => 'mega-v5',
                'active' => $controller == 'course',
                'name' => Yii::t('common', 'menu.courses'),
                'children' => $this->getMegaContent(4),
            ),

            array(
                'type' => 'tree',
                'active' => $controller == 'news',
                'name' => Yii::t('common', 'menu.news'),
                'children' => $this->getTreeContent(NewsCategory::find()->all()),
            ),

            array(
                'type' => 'single',
                'active' => false,
                'name' => Yii::t('common', 'menu.promotion'),
                'url' => Yii::$app->urlManager->createUrl(['/promotion/list']),
            ),
            array(
                'type' => 'single',
                'active' => false,
                'name' => Yii::t('common', 'menu.testimonials'),
                'url' => Yii::$app->urlManager->createUrl(['/testimonial/list']),
            ),
            /* array(
                           'type' => 'tree',
                           'active' => $controller == 'news',
                           'name' => Yii::t('common', 'menu.news'),
                           'children' => array(
                               array(
                                   'label' => 'Sub 2',
                                   'active' => $controller == 'settings' AND ( $action == 'foo' OR  $action == 'bar'),
                                   'children' => array(
                                       array(
                                           'label' => 'Item 1',
                                           'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                           'active' => $controller == 'settings' AND $action == 'foo',
                                       ),
                                       array(
                                           'label' => 'Item 2',
                                           'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                           'active' => $controller == 'settings' AND $action == 'bar',
                                       ),
                                       array(
                                           'label' => 'Sub 3',
                                           'active' => $controller == 'settings' AND $action == 'bar',
                                           'children' => array(
                                               array(
                                                   'label' => 'Item 1',
                                                   'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                                   'active' => $controller == 'settings' AND $action == 'foo',
                                               ),
                                               array(
                                                   'label' => 'Item 2',
                                                   'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                                   'active' => $controller == 'settings' AND $action == 'bar',
                                               ),
                                               array(
                                                   'label' => 'Sub3',
                                                   'active' => $controller == 'settings' AND $action == 'bar',
                                                   'children' => array(
                                                       array(
                                                           'label' => 'Item 1',
                                                           'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                                           'active' => $controller == 'settings' AND $action == 'foo',
                                                       ),
                                                       array(
                                                           'label' => 'Item 2',
                                                           'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                                           'active' => $controller == 'settings' AND $action == 'bar',
                                                       ),
                                                       array(
                                                           'label' => 'Item 3',
                                                           'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                                           'active' => $controller == 'settings' AND $action == 'bar',
                                                       ),
                                                   )
                                               ),
                                           )
                                       ),
                                   )
                               ),
                               array(
                                   'label' => 'Item 2',
                                   'url' => Yii::$app->urlManager->createUrl(['/settings/index']),
                                   'active' => $controller == 'settings' AND $action == 'index',
                               ),
                               array(
                                   'label' => 'Item 3',
                                   'url' => Yii::$app->urlManager->createUrl(['/settings/change-password']),
                                   'active' => $controller == 'settings' AND $action == 'change-password',
                               )
                           ),
                       ),*/
            /* array(
                 'type' => 'mega-default',
                 'active' => true,
                 'name' => Yii::t('common', 'menu.home'),
                 'children' => array(
                     array(
                         'label' => 'Mega Header 1',
                         'children' => array(
                             array(
                                 'label' => 'Item 1',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                 'active' => true,
                                 'icon' => 'fa fa-money'
                             ),
                             array(
                                 'label' => 'Item 2',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                 'active' => $controller == 'settings' AND $action == 'bar',
                                 'icon' => 'fa fa-usd'
                             ),
                         )
                     ),
                     array(
                         'label' => 'Mega Header 2',
                         'children' => array(
                             array(
                                 'label' => 'Item 1',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                 'active' => $controller == 'settings' AND $action == 'foo',
                                 'icon' => 'fa fa-money'
                             ),
                             array(
                                 'label' => 'Item 2',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                 'active' => $controller == 'settings' AND $action == 'bar',
                                 'icon' => 'fa fa-usd'
                             ),
                         )
                     ),
                     array(
                         'label' => 'Mega Header 3',
                         'children' => array(
                             array(
                                 'label' => 'Item 1',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                 'active' => $controller == 'settings' AND $action == 'foo',
                                 'icon' => 'fa fa-money'
                             ),
                             array(
                                 'label' => 'Item 2',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                 'active' => $controller == 'settings' AND $action == 'bar',
                                 'icon' => 'fa fa-usd'
                             ),
                         )
                     ),
                     array(
                         'label' => 'Mega Header 4',
                         'children' => array(
                             array(
                                 'label' => 'Item 1',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                 'active' => $controller == 'settings' AND $action == 'foo',
                                 'icon' => 'fa fa-money'
                             ),
                             array(
                                 'label' => 'Item 2',
                                 'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                 'active' => $controller == 'settings' AND $action == 'bar',
                                 'icon' => 'fa fa-usd'
                             ),
                         )
                     ),
                 ),
             ),*/
            /*array(
                'type' => 'mega-v5',
                'active' => true,
                'name' => Yii::t('common', 'menu.courses'),
                'children' => array(
                    array(
                            array(
                                'label' => 'Mega Header 1 - 1',
                                'children' => array(
                                    array(
                                        'label' => 'Item 1',
                                        'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                        'active' => true,
                                    ),
                                    array(
                                        'label' => 'Item 2',
                                        'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                        'active' => $controller == 'settings' AND $action == 'bar',
                                    ),
                                )
                            ),
                            array(
                                'label' => 'Mega Header 1 - 2',
                                'children' => array(
                                    array(
                                        'label' => 'Item 1',
                                        'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                        'active' => false,
                                    ),
                                    array(
                                        'label' => 'Item 2',
                                        'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                        'active' => $controller == 'settings' AND $action == 'bar',
                                    ),
                                    array(
                                        'label' => 'Item 2',
                                        'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                        'active' => $controller == 'settings' AND $action == 'bar',
                                    ),
                                )
                            ),
                    ),
                    array(
                        array(
                            'label' => 'Mega Header 2 - 1',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                        array(
                            'label' => 'Mega Header 2 - 2',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                        array(
                            'label' => 'Mega Header 2 - 3',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                    ),
                    array(
                        array(
                            'label' => 'Mega Header 3 - 1',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                        array(
                            'label' => 'Mega Header 3 - 2',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                    ),
                    array(
                        array(
                            'label' => 'Mega Header 4 - 1',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                        array(
                            'label' => 'Mega Header 4 - 2',
                            'children' => array(
                                array(
                                    'label' => 'Item 1',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/foo']),
                                    'active' => false,
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                                array(
                                    'label' => 'Item 2',
                                    'url' => Yii::$app->urlManager->createUrl(['/settings/bar']),
                                    'active' => $controller == 'settings' AND $action == 'bar',
                                ),
                            )
                        ),
                    ),
                ),
            )*/
        );
        $this->view->params['mainMenu'] = $this->mainMenu;
    }
}

