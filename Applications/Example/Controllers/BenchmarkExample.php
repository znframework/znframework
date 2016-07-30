<?php
class BenchmarkExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'test'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function test()
	{
		Benchmark::start('test1');
		
		for($i = 0; $i < 100; $i++ )
		{
			$i;	
		}	
		
		DB::get();
		
		Benchmark::end('test1');
		
		Benchmark::start('test2');
		
		for($x = 0; $x < 10000; $x++ )
		{
			$x;	
		}	
		
		$test = 1;
		
		Benchmark::end('test2');
		
		// Geçen Zamanı Öğrenmek
		// p1: Test adı
		// p2: Ondalıklı bölümün kaç haneli olacağı.
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Elapsed Time' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Test1 Elapsed Time: '.Benchmark::elapsedTime('test1', 6) );
		writeLine( 'Test2 Elapsed Time: '.Benchmark::elapsedTime('test2', 6) );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Calculated Memory' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Test1 Memory Usage: '.Benchmark::calculatedMemory('test1') );
		writeLine( 'Test2 Memory Usage: '.Benchmark::calculatedMemory('test2') );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Used File Count' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Test1 Used File Count: '.Benchmark::usedFileCount('test1') );
		writeLine( 'Test2 Used File Count: '.Benchmark::usedFileCount('test2') );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Used Files' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Test1 Used Files: '.implode('<br>', Benchmark::usedFiles('test1')) );
		writeLine( 'Test2 Used Files: '.implode('<br>', Benchmark::usedFiles('test2')) );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'System Memory Usage' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Memory Usage: '.Benchmark::memoryUsage() );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'System Max  Memory Usage' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Max Memory Usage: '.Benchmark::maxMemoryUsage() );
		write( '---------------------------------------------------------------------' );
	}
}