<?php

use yii\db\Migration;

/**
 * Class m221110_134731_init_db
 */
class m221110_134731_init_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'number' => $this->string(),
            'address' => $this->text(),
            'birthday_date' => $this->date()
        ]);

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createTable('user_tag', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->addForeignKey('user_tag_user_fk', 'user_tag', 'user_id', 'user', 'id', 'SET NULL');
        $this->addForeignKey('user_tag_tag_fk', 'user_tag', 'tag_id', 'tag', 'id', 'SET NULL');

        $this->insert('user', [
            'name' => 'Paweł',
            'surname' => 'Jędrzejczyk',
            'number' => '+48503234233',
            'address' => "ul. Kowalska 2\n02-400 Kraków",
            'birthday_date' => '2000-01-01'
        ]);

        $this->insert('user', [
            'name' => 'Piotr',
            'surname' => 'Jakiśtamski',
            'number' => '+48603234233',
            'address' => "ul. Jakaśtamska 2\n01-100 Gdzieśtam",
            'birthday_date' => '1960-01-01'
        ]);

        $this->insert('user', [
            'name' => 'Roman',
            'surname' => 'Kowalski',
            'number' => '+48303234233',
            'address' => "ul. Czeska 2\n03-400 Olsztyn",
            'birthday_date' => '1970-01-01'
        ]);

        $this->insert('user', [
            'name' => 'Adam',
            'surname' => 'Nowak',
            'number' => '+48203234233',
            'address' => "ul. Słowacka 2\n02-500 Warszawa",
            'birthday_date' => '2015-01-01'
        ]);

        $this->insert('user', [
            'name' => 'Bonifacy',
            'surname' => 'Lewandowski',
            'number' => '+48103234233',
            'address' => "ul. Rumuńska 2\n07-200 Wrocław",
            'birthday_date' => '2010-01-01'
        ]);

        $this->insert('tag', ['name' => 'spaghetti']);
        $this->insert('tag', ['name' => 'tagliatelli']);
        $this->insert('tag', ['name' => 'penne']);
        $this->insert('tag', ['name' => 'lasagna']);
        $this->insert('tag', ['name' => 'vermicelli']);
        $this->insert('tag', ['name' => 'macaroni']);
        $this->insert('tag', ['name' => 'bavette']);
        $this->insert('tag', ['name' => 'bigoli']);
        $this->insert('tag', ['name' => 'pappardelle']);

        $this->insert('user_tag', ['user_id' => 1, 'tag_id' => 1]);
        $this->insert('user_tag', ['user_id' => 2, 'tag_id' => 1]);
        $this->insert('user_tag', ['user_id' => 3, 'tag_id' => 1]);
        $this->insert('user_tag', ['user_id' => 4, 'tag_id' => 1]);
        $this->insert('user_tag', ['user_id' => 5, 'tag_id' => 1]);

        $this->insert('user_tag', ['user_id' => 1, 'tag_id' => 2]);
        $this->insert('user_tag', ['user_id' => 2, 'tag_id' => 2]);
        $this->insert('user_tag', ['user_id' => 3, 'tag_id' => 2]);
        $this->insert('user_tag', ['user_id' => 4, 'tag_id' => 2]);

        $this->insert('user_tag', ['user_id' => 1, 'tag_id' => 3]);
        $this->insert('user_tag', ['user_id' => 2, 'tag_id' => 3]);
        $this->insert('user_tag', ['user_id' => 3, 'tag_id' => 3]);

        $this->insert('user_tag', ['user_id' => 1, 'tag_id' => 4]);
        $this->insert('user_tag', ['user_id' => 2, 'tag_id' => 4]);

        $this->insert('user_tag', ['user_id' => 3, 'tag_id' => 5]);
        $this->insert('user_tag', ['user_id' => 4, 'tag_id' => 5]);

        $this->insert('user_tag', ['user_id' => 3, 'tag_id' => 6]);
        $this->insert('user_tag', ['user_id' => 4, 'tag_id' => 6]);

        $this->insert('user_tag', ['user_id' => 5, 'tag_id' => 7]);

        $this->insert('user_tag', ['user_id' => 5, 'tag_id' => 8]);

        $this->insert('user_tag', ['user_id' => 5, 'tag_id' => 9]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_tag_tag_fk', 'user_tag');
        $this->dropForeignKey('user_tag_user_fk', 'user_tag');
        $this->dropTable('user_tag');
        $this->dropTable('tag');
        $this->dropTable('user');
    }
}
