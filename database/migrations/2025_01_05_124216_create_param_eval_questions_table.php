<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('param_eval_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable(true);
            $table->text('question', 500);
            $table->enum('ratable_flag', ['Y', 'N'])->default('Y');
            $table->enum('active_flag', ['Y', 'N'])->default('Y');
            $table->double('sort_order', 8, 1)->default(0);
            $table->timestamps();

          
        });

        DB::unprepared(
            "
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (NULL,'Event Organization','N','Y',0.0);
            
            SET @parent_id_1 = LAST_INSERT_ID();  
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_1, 'How would you rate the overall organization of the event?', 'Y', 'Y', 0.1);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_1, 'Was the event schedule communicated clearly in advance?', 'Y', 'Y', 0.2);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_1, 'How effective was the registration process for the event?', 'Y', 'Y', 0.3);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_1, 'Were the event location and facilities adequate and accessible?', 'Y', 'Y', 0.4);
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_1, 'How would you rate the timeliness of the event (e.g., did sessions start and end on time)?', 'Y', 'Y', 0.5);
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (NULL, 'Content & Presentations', 'N', 'Y', 0.0);
            
            SET @parent_id_2 = LAST_INSERT_ID();  
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_2, 'How relevant was the content to your interests or needs?', 'Y', 'Y', 0.1);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_2, 'Were the presentations well-structured and easy to follow?', 'Y', 'Y', 0.2);
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_2, 'How engaging were the speakers or presenters?', 'Y', 'Y', 0.3);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_2, 'Was the information presented in a clear and understandable way?', 'Y', 'Y', 0.4);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_2, 'How would you rate the balance between theoretical and practical content?', 'Y', 'Y', 0.5);
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (NULL, 'Event Logistics & Support', 'N', 'Y', 0.0);
            
            SET @parent_id_3 = LAST_INSERT_ID();  
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_3, 'Was the event venue comfortable (temperature, seating, etc.)?', 'Y', 'Y', 0.1);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_3, 'How would you rate the availability and accessibility of event staff?', 'Y', 'Y', 0.2);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_3, 'Were the event materials (handouts, digital resources) helpful?', 'Y', 'Y', 0.3);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_3, 'Was the technology (AV equipment, Wi-Fi) functional and reliable?', 'Y', 'Y', 0.4);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_3, 'Were there adequate signs and directions to help you navigate the venue?', 'Y', 'Y', 0.5);
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (NULL, 'Overall Experience', 'N', 'Y', 0.0);
            
            SET @parent_id_4 = LAST_INSERT_ID(); 
        
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_4, 'How satisfied are you with the overall event experience?', 'Y', 'Y', 0.1);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_4, 'How likely are you to attend a similar event in the future?', 'Y', 'Y', 0.2);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_4, 'How would you rate the value of the event relative to the cost (if applicable)?', 'Y', 'Y', 0.3);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_4, 'Would you recommend this event to others?', 'Y', 'Y', 0.4);
            
            INSERT INTO param_eval_questions (`parent_id`,`question`,`ratable_flag`,`active_flag`,`sort_order`) 
            VALUES (@parent_id_4, 'What was the most memorable aspect of the event?', 'Y', 'Y', 0.5);
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_eval_questions');
    }
};
