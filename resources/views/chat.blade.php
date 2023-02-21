@extends('layout')
@section('header')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/chat.css')}}">

<div class="container-fluid p-0">
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Usuarios</h4>
                    </div>
                </div>
                <div class="inbox_chat">
                    <?php

                    $first = true;

                    if($target) $first = false;

                    foreach ($chatData as $currentIteration){
                        $unread = false;
                        foreach ($unreadChats as $unreadChat){
                            if($unreadChat['sender'] == $currentIteration[0][0]) $unread = true;
                        }
                        echo '<div class="chat_list interactive';
                        if($first || ($target)&& $target == $currentIteration[0][1]){
                            echo ' active_chat';
                            $first = false;
                        }if($unread) echo ' unread';

                        echo'" data-target="'.$currentIteration[0][1].'">
                            <div class="chat_people">
                            <div class="chat_ib">
                            <h5>'.ucfirst(strtolower($currentIteration[0][0])).' ';

                        if(isset($currentIteration[1][0])) echo '<span class="chat_date">'.$currentIteration[1][0]['created_at'].'</span></h5>
                            <p>'.$currentIteration[1][0]['message'].'</p>';
                        echo '

                            </div>
                            </div>
                            </div>';
                    }

                    ?>
                </div>
            </div>
            <div class="mesgs">
                <div class="msg_history">
                    <?php

                    $first = true;

                    if($target) $first = false;

                    foreach ($chatData as $currentIteration){
                        echo '<div class="chat';

                        if($first || ($target && $target == $currentIteration[0][1])) $first = false;
                        else echo ' d-none';

                        echo'" data-content="'.$currentIteration[0][1].'">';
                        foreach ($currentIteration[1] as $message){
                            if($message['sender'] == $adminData[0])
                                echo '<div class="outgoing_msg">
                                    <div class="sent_msg">
                                    <p>'.$message['message'].'</p>
                                    <span class="time_date">'.$message['created_at'].'</span></div>
                                    </div>';
                            else echo ' <div class="incoming_msg">
                                      <div class="received_msg">
                                      <div class="received_withd_msg">
                                      <p>'.$message['message'].'</p>
                                      <span class="time_date">'.$message['created_at'].'</span></div>
                                      </div>
                                      </div>';
                        }
                        echo'</div>';
                    }

                    ?>
                </div>
                <div class="type_msg bfg">
                    <div class="input_msg_write">
                        <form method="post" action="{{url('sendMessage')}}">
                            {{csrf_field()}}
                            <input id="receiver" type="hidden" name="receiver" value="<?php if($target) echo $target; else echo $chatData[0][0][1]; ?>">
                            <input type="text" class="write_msg" name="message" placeholder="Escribe un mensaje" autocomplete="off" required/>
                            <button title="Enviar" class="msg_send_btn" type="submit"><i class="glyphicon glyphicon-chevron-right" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')

