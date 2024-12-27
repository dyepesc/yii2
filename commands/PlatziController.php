<?php

namespace app\commands;

use app\models\Author;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\Book;


class PlatziController extends Controller {

    /**
     * Suma los valores de dos numeros
     */
    public function actionSuma($a, $b) {
        $result = $a + $b;
        printf("%0.2f\n", $result);
        return ExitCode::OK;
    }

    public function actionBooks($file) {

        $f = fopen($file, "r");
        while (!feof($f)) {
            $data = fgetcsv($f);

            if(!empty($data[1]) && !empty($data[2])) {
                //check if the autor exists
                $author = Author::find()
                    ->where(['name' => $data[2]])
                    ->one();
                if(empty($author)) {
                    $author = new Author();
                    $author->name = $data[2];
                    $author->save();
                }

                $book = new Book;
                $book->title = $data[1];
                $book->author_id = $author->id;
                $book->save();

                printf("%s\n", $book->toString());
            }

        }
        fclose($f);
        return ExitCode::OK;
    }

    public function actionAuthor($author_id) {
//        $author = Author::find()->where(['author_id' => $author_id])->one();
        $author = Author::findOne($author_id);      //these two are equals

        if(empty($author)) {
            printf("no existe el autor %s\n", $author_id);
            return ExitCode::DATAERR;
        }
        printf("%s:\n", $author->toString());
            foreach($author->books as $book) {
                printf(" - %s\n", $book->toString());
            }

        return ExitCode::OK;
    }

    public function actionBook($book_id) {
        $book = Book::findOne($book_id);
        if(empty($book)) {
            printf("no existe el book %s\n", $book_id);
            return ExitCode::DATAERR;
        }
        printf("%s\n", $book->toString());
        return ExitCode::OK;
    }
}
