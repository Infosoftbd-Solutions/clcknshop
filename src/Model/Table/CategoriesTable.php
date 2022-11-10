<?php

namespace App\Model\Table;

use App\Model\Entity\Category;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method Category get($primaryKey, $options = [])
 * @method Category newEntity($data = null, array $options = [])
 * @method Category[] newEntities(array $data, array $options = [])
 * @method Category|false save(EntityInterface $entity, $options = [])
 * @method Category saveOrFail(EntityInterface $entity, $options = [])
 * @method Category patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Category[] patchEntities($entities, array $data, array $options = [])
 * @method Category findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class CategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->belongsToMany('Products', [
            'through' => 'CategoriesHasProducts',
            'foreignKey' => 'categories_id',
            'targetForeignKey' => 'products_id'
        ]);
        /* $this->belongsTo('Categories', [
             'foreignKey' => 'categories_id',
             'joinType' => 'INNER',
         ]);  */
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->add('slug',
                        ['unique' => [
                            'rule' => 'validateUnique',
                            'provider' => 'table',
                            'message' => 'Not unique']
                        ]
                    )
            ->allowEmptyString('slug');

      /*  $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyString('image'); */


        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');


        return $validator;
    }

    function isUnique($slug){
      pr($this->request->getData());
        $user = $this->find('all')
            ->where([
                'Categories.slug' => $slug,
            ])
            ->first();
        if($user){
            return false;
        }
        return true;
    }


    public function collectionProducts($c_id = 0){
        $CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts');
        $Products              = TableRegistry::getTableLocator()->get('Products');

        if ($c_id > 0){
            $c_tion = $this->get($c_id);
            $sql = null;

            if ($c_tion->manual_matching){
//                    manual matching
                $products_id = $CategoriesHasProducts->find()->select('products_id')->where(['categories_id' => $c_id])->extract('products_id')->toList();
                if (count($products_id) > 0){
                    $products = $Products->find('all')->where(['id IN' => $products_id]);
                }else{
                    $products = $Products->find('all')->where(['id' => -1]);
                }

            }else{
//                    automatic matching
                $match_con = $c_tion->match_cond;
                $match_con = json_decode($match_con, true);
                $fields = [
                    'title_match' => 'title',
                    'type_match' => 'product_type',
                    'tag_match' => 'tags',
                ];
                foreach ($match_con as $key => $con){
                    if (isset($con) && !empty($con)){
                        $arr = explode(',', trim($con));
                        foreach ($arr as $ar){
                            $sql .= $fields[$key] . " LIKE '%". $ar ."%' OR ";
                        }
                    }
                }

                $sql = substr($sql, 0, -3);
                $products = $Products->find('all')->where($sql);
            }

        }else{
            $products = $Products->find('all');
        }

        return $products;
    }


    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     *
     * public function buildRules(RulesChecker $rules)
     * {
     * $rules->add($rules->existsIn(['categories_id'], 'Categories'));
     *
     * return $rules;
     * } */
}
